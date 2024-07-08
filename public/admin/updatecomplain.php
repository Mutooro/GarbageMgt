<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '..\PHPMailer\src\Exception.php';
require '..\PHPMailer\src\PHPMailer.php';
require '..\PHPMailer\src\SMTP.php';

$con = mysqli_connect('localhost', 'root', '', 'project_gcs');

 // Database query to fetch admin's email
 $sql_admin = "SELECT email, name FROM admin WHERE id = 1"; 
 $result_admin = mysqli_query($con, $sql_admin);

 if ($result_admin) {
     $admin_row = mysqli_fetch_assoc($result_admin);
     if ($admin_row) {
         $admin_email = $admin_row['email'];
         $admin_name = $admin_row['name'];
     } else {
         echo "Admin not found.";
         exit;
     }
 } else {
     echo "Error fetching admin email: " . mysqli_error($con);
     exit;
 }

if (isset($_POST['update'])) {
    $complain = $_POST['complain_id'];
    $complain_msg = $_POST['description'];
    $assigned_driver = $_POST['assigned_driver'];
    $assigned_date = $_POST['assigned_date'];
    $assign_desc = $_POST['description'];
    $complainstatus = $_POST['complain_status'];

    //For user details
    $usersql = "SELECT user_id,bin_id FROM complaints WHERE complain_id = $complain";
    $result = mysqli_query($con, $usersql);
    // Fetch the user ID from the result
    $row = mysqli_fetch_assoc($result);
    $userId = $row['user_id'];
    $binId = $row['bin_id'];

    //for email and user name
    $usersql2 = "SELECT user_name,email FROM users WHERE user_id =  $userId";
    $result2 = mysqli_query($con, $usersql2);
    $row2 = mysqli_fetch_assoc($result2);
    $username = $row2['user_name'];
    $useremail = $row2['email'];


    //for driver email
    $driversql = "SELECT driver_id,email FROM drivers WHERE driver_name ='$assigned_driver'";
    $dresult = mysqli_query($con, $driversql);
    $row3 = mysqli_fetch_assoc($dresult);
    $driveremail =  $row3['email'];
    $driverid = $row3['driver_id'];

    $qry1 = "UPDATE complaints set complain_status='$complainstatus' WHERE complain_id = $complain ";
    $qryreject  = "UPDATE garbagebins set bin_status = 'use' WHERE bin_id = $binId";
    $notify1 = "INSERT INTO notification (from_id,to_id,message) VALUES (1,$userId,'Your Complain Status is here.')";
    $notify2 = "INSERT INTO notification (from_id,to_id,message) VALUES (1,$driverid,'Your Assigned Work is here.')";
    mysqli_query($con,$notify1);
    if (strcmp($complainstatus, 'Rejected') == 0) {

        if (mysqli_query($con, $qry1) &&  mysqli_query($con, $qryreject)) {
            $to =  $useremail;
            $subject = "Complaint Reply";
            $header = "From:admin@gcs.com";
            $message = "Dear $username,\n\n";
            $message .= "Thank you for your Complain.\n\n";
            $message .= "$complain_msg \n\n";
            $message .= "Best regards,\n";
            $message .= "Garbage Complain System";
            if (mail($to, $subject, $message, $header)) {

                echo '<script> alert("Complain Rejected"); </script> ';
                header('location:dashboard.php');
            }
        }
    } else {
        $qry2 = "INSERT INTO assigned_bin(complain_id,assigned_driver,assignment_date,assign_des) VALUES ($complain,'$assigned_driver','$assigned_date','$assign_desc')";
        $qry3  = "UPDATE drivers set driver_status = 'Assigned' WHERE driver_name ='$assigned_driver'";
        $qry4  = "UPDATE garbagebins set bin_status = 'On Collection' WHERE bin_id = $binId";
        if (mysqli_query($con, $qry1) &&  mysqli_query($con, $qry2) && mysqli_query($con, $qry3) &&  mysqli_query($con, $qry4) && mysqli_query($con,$notify2)) {

            echo '<script>alert("Complain Accepted and Updated.")</script>';

            $to =  $useremail;
            $dto = $driveremail;
           // Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'mutoorom@gmail.com'; 
    $mail->Password   = 'gnsi ltcz hqyy arlc'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Recipients for the user
    $mail->setFrom($admin_email, 'Garbage Complaint System');
    $mail->addAddress($to);  // Add a recipient

    // Content for the user
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body    = $message;

    // Send the email to the user
    $mail->send();

    // Recipients for the driver
    $mail->clearAddresses();
    $mail->addAddress($dto);  // Add a recipient

    // Content for the driver
    $mail->Subject = $dsubject;
    $mail->Body    = $dmessage;

    // Send the email to the driver
    $mail->send();

    echo '<script>alert("Update Mail is sent to user and driver.")</script>';
} catch (Exception $e) {
    echo '<script>alert("Error sending mail: ' . $mail->ErrorInfo . '")</script>';
}

            echo '<script>window.location.href = "dashboard.php";</script>';
        } else {
            echo '<script>alert("Error Updating Complain.Please try again later.")</script>';
        }
    }
}
$con->close();
