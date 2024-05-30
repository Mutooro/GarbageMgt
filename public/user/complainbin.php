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
                    <div class="mb-4">
                        <label for="capacity" class="block text-gray-700 font-semibold mb-2">Bin Type</label>
                        <span class=" block border border-gray-300 p-2 w-full bg-violet-100"><?php echo $row['type'] ?></span>

                    </div>
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

require '..\PHPMailer/src/Exception.php';
require '..\PHPMailer/src/PHPMailer.php';
require '..\PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {
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

            // Mail to admin using Gmail SMTP with PHPMailer
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'mutoorom@gmail.com'; // Your Gmail address
                $mail->Password   = 'gnsi ltcz hqyy arlc'; // Your Gmail password
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                //Recipients
                $mail->setFrom('mutoorom@gmail.com', $user); // Your email address and name
                $mail->addAddress('martin.mutooro@gmail.com', 'Admin'); // Admin's email address and name
                
                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Complaint Notification';
                $mail->Body    = "Dear Admin,<br><br>I would like to report a complaint regarding the garbage bin $binId<br><br>Complaint details: $comp_msg<br><br>Waiting for your Reply.<br><br>Best regards,<br>$user";
                
                $mail->send();
                echo '<script> alert("Bin Complain Successfully"); </script> ';
                echo '<script>window.location.href = "userdashboard.php";</script>';
            } catch (Exception $e) {
                echo '<script> alert("Error: ' . $mail->ErrorInfo . '"); </script>';
            }
        } else {
            echo '<script> alert("Error: Please try again."); </script>';
        }
    } else {
        echo '<script> alert("This bin is already Reported Or on collection."); </script>';
    }
}
?>

