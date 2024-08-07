<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bin Complaint Form</title>
    <link rel="stylesheet" href="../style.css">
</head>
<?php include('userdashlayout.php') ?>

<body class="bg-gray-100">
    <?php
    $binid = $_GET['binid'];
    $qry = "SELECT * FROM garbagebins WHERE bin_id = $binid";
    $result = mysqli_query($con, $qry);
    $row = mysqli_fetch_assoc($result);
    $binid = $row['bin_id'] ?>
    ?>
    <div class=" w-full h-full p-5 ml-14 md:ml-64">
        <div class="w-full">
            <h2 class="text-3xl border-b-2 border-blue-600">Complain Bin</h2>
        </div>
        <div class="w-1/2 md:w-96 md:max-w-full mx-auto">
            <div class="px-4 py-8 rounded-lg shadow-md p-6 mb-6">
                <div class="">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2 ">Bin ID</label>
                        <span class=" block border border-gray-300 p-2 w-full bg-violet-100"><?php echo $row['bin_id'] ?></span>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2 ">Location</label>
                        <span class=" block border border-gray-300 p-2 w-full bg-violet-100"><?php echo $row['location'] ?></span>

                    </div>
                    <!-- <div class="mb-4">
                        <label for="capacity" class="block text-gray-700 font-semibold mb-2">Bin Type</label>
                        <span class=" block border border-gray-300 p-2 w-full bg-violet-100"><?php echo $row['type'] ?></span>

                    </div> -->
                    <div class="mb-4">
                        <label for="capacity" class="block text-gray-700 font-semibold mb-2">Capacity</label>
                        <span class=" block border border-gray-300 p-2 w-full bg-violet-100"><?php echo $row['capacity'] ?></span>

                    </div>
                </div>
                <form class="" method="post" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="complaint_message" class="block text-gray-700 font-semibold mb-2">Complaint Message</label>
                        <textarea id="complaint_message" name="complaint_message" class="border border-gray-300 p-2 w-full h-24" placeholder="Enter your complaint message" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="bin_picture" class="block text-gray-700 font-semibold mb-2">Upload Bin Picture</label>
                        <input id="bin_picture" type="file" name="bin_photo" class="border border-gray-300 p-2 w-full" required>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Submit Complaint" name="submit" class="w-full bg-blue-500 text-white font-semibold px-4 py-2 rounded hover:bg-blue-600" onclick="confirm('Are you sure to submit complain.')">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<?php

use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['complaint_message'])) {
    

    require '..\PHPMailer\src\Exception.php';
    require '..\PHPMailer\src\PHPMailer.php';
    require '..\PHPMailer\src\SMTP.php';

    
    

    // Assuming you have logged in user information available in $_SESSION or similar
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        $loggedInUsername = $_SESSION['username'];
    } else {
        echo "No user logged in.";
        exit;
    }

    
    $sql_user = "SELECT user_name, email FROM users WHERE user_name = '$loggedInUsername'";
    $result_user = mysqli_query($con, $sql_user);

    if ($result_user) {
        $user_row = mysqli_fetch_assoc($result_user);
        if ($user_row) {
            $user_email = $user_row['email'];
            $user_name = $user_row['user_name'];
        } else {
            echo "User not found.";
            exit;
        }
    } else {
        echo "Error fetching user email: " . mysqli_error($con);
        exit;
    }

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

    $filename = $_FILES["bin_photo"]["name"];
    $tempname = $_FILES["bin_photo"]["tmp_name"];
    $folder = "binpic/" . $filename;
    move_uploaded_file($tempname, $folder);

    $comp_msg = $_POST['complaint_message'];

    $qry1 = "SELECT bin_status FROM garbagebins WHERE bin_id = $binid ";
    $res = mysqli_query($con, $qry1);
    $row = mysqli_fetch_assoc($res);
    $binstatus = $row['bin_status'];

    if (strcmp($binstatus, 'use') == 0) {
        $qry2 = "INSERT INTO complaints (user_id, bin_id, description, bin_picture, timestamp) VALUES ($userid, $binid, '$comp_msg', '$folder', CURRENT_TIMESTAMP)";
        $notify1 = "INSERT INTO notification (from_id,to_id,message) VALUES ($userid,1,'New Complain is here.')";
        if (mysqli_query($con, $qry2) && mysqli_query($con, $notify1)) {
            $qry2 = "UPDATE garbagebins set bin_status = 'Complained' WHERE bin_id = $binid ";
            mysqli_query($con, $qry2);

    // Create a PHPMailer instance
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

        // Recipients
        $mail->setFrom($user_email, $user_name);
        $mail->addAddress($admin_email, $admin_name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Complaint Notification';
        $mail->Body    = "Dear Admin,<br><br>I would like to report a complaint regarding the garbage bin $binid<br><br>Complaint details: " . $_POST['complaint_message'] . "<br><br>Waiting for your Reply.<br><br>Best regards,<br>$user_name";

        // Send email
        $mail->send();

        echo '<script> alert("Bin Complaint Sent Successfully"); </script> ';
        echo '<script>window.location.href = "userdashboard.php";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo '<script> alert("This bin is already Reported Or on collection."); </script>';
}
}
}
?>
