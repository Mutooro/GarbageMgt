<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../../node_modules/datatables.net-dt/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="table.css">

</head>

<body class="bg-gray-200">
    <div class="flex">
        <?php include('dashlayout.php'); ?>

        <div class="h-full w-full p-5 ml-14 md:ml-64  ">
            <div class="w-full p-5 ">
                <h2 class="text-3xl border-b-2 border-blue-600">Users Feedbacks</h2>
            </div>
            <div class="container mx-auto px-4 py-8">
            <div class="w-full flex flex-col">
            <div class="flex-grow overflow-auto">
                <table id="myTable" class="min-w-full">
                    <thead>
                        <tr class="bg-green-100 ">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Timestamp</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM feedback ORDER BY status ASC";
                        $res = mysqli_query($con, $sql);
                        $x = 1;
                        while ($data = mysqli_fetch_assoc($res)) {
                            $timestamp = $data['timestamp'];
                            $date = date('F j, Y', strtotime($timestamp));
                        ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $x ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"> <?php echo $date ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $data['name'] ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo $data['email'] ?></td>
                                <td class="px-6 py-4 whitespace-wrap"><?php echo $data['message'] ?></td>
                                <td class="px-6 py-4 whitespace-wrap">
                                    <?php echo ($data['status'] == 1) ? "Replied" : "Not Replied"; ?>
                                </td>

                                <td class="flex">
                                    <button onclick="openPopupForm(<?php echo $data['id'] ?>,'<?php echo $data['name'] ?>','<?php echo $data['message'] ?>','<?php echo $data['email'] ?>','<?php echo $data['status'] ?>');" class="mx-2 px-3 py-2 bg-sky-400 rounded-lg text-white hover:bg-blue-700">Reply</button>
                                    <a onclick="showDelete(<?php echo $data['id'] ?>);" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded cursor-pointer">Delete</a>
                                </td>

                            </tr>
                        <?php $x++;
                        } ?>
                    </tbody>
                </table>
                    </div>
             </div>
            </div>
        </div>
    </div>

    <div id="deletebox" class="hidden fixed inset-0 bg-opacity-40 backdrop-blur-sm">
        <div class="flex h-full justify-center items-center">
            <div class="flex flex-col p-10 rounded-lg shadow bg-white">
                <div class="text-center">
                    <h2 class="font-semibold text-gray-800">Are you sure want to delete?</h2>
                </div>
                <div class="flex items-center mt-6">
                    <button onclick="hideDelete()" class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
                        Cancel
                    </button>
                    <a href="" id="agree" class="flex-1 px-4 py-2 ml-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-md text-center">
                        Agree
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="popupForm" class="hidden">
        <div class="h-96 fixed inset-0 z-10 flex items-center justify-center backdrop-blur-md bg-gray-400 bg-opacity-40">
            <div class="w-2/5 bg-white rounded-md shadow-lg h-4/5">
                <div class="px-10 py-5 w-full h-full">
                    <div class="flex justify-between">
                        <h2 class="text-xl font-semibold mb-4">Reply to User Feedback</h2>
                        <span onclick=" closePopupForm()"> <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="default-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </span>
                    </div>
                    <div>
                        <form method="post">
                            <input type="hidden" name="fid" id="fid" value="">
                            <div class="mb-4">
                                <label for="user-name" class="block font-medium text-gray-700 mb-2">User Name:</label>
                                <input id="user-name" name="user-name" type="text" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="user-email" class="block font-medium text-gray-700 mb-2">User Email:</label>
                                <input id="user-email" name="user-email" type="text" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="user-feedback" class="block font-medium text-gray-700 mb-2">User Feedback:</label>
                                <textarea id="user-feedback" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500" rows="3" readonly></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="admin-reply" class="block font-medium text-gray-700 mb-2">Admin Reply:</label>
                                <textarea id="admin-reply" name="admin-msg" class="w-full border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500" rows="3" placeholder="Enter your reply..."></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" name="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Submit Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function openPopupForm(id, x, y, z, o) {

            if (o == 1) {
                alert("Already Replied");
                return;
            }
            document.getElementById('fid').value = id;
            document.getElementById('user-name').value = x;
            document.getElementById('user-feedback').value = y;
            document.getElementById('user-email').value = z;
            const popupForm = document.getElementById('popupForm');
            popupForm.classList.remove('hidden');
        }

        function closePopupForm() {
            const popupForm = document.getElementById('popupForm');
            popupForm.classList.add('hidden');
        }
    </script>
     <script>
        function showDelete(x) {
            document.getElementById("deletebox").style.display = "block";
            document.getElementById('agree').href = "deletebin.php?id=" + x;

        }

        function hideDelete() {
            document.getElementById("deletebox").style.display = "none";
        }
    </script>

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>


<!-- replying to feedbach -->
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '..\PHPMailer/src/Exception.php';
require '..\PHPMailer/src/PHPMailer.php';
require '..\PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    $id = $_POST['fid'];
    $name = $_POST['user-name'];
    $to = $_POST['user-email'];
    $msg = $_POST['admin-msg'];
    $subject = "Feedback Reply";
    $message = "Dear $name,\n\n";
    $message .= "Thank you for contacting us.\n\n";
    $message .= "$msg \n\n";
    $message .= "Best regards,\n";
    $message .= "Garbage Complaint System";
    
    //db connection
    $sql_admin = "SELECT email FROM admin WHERE id = 1"; // Adjust the query as per your database schema
    $result_admin = mysqli_query($con, $sql_admin);
    
    if ($result_admin) {
        $admin_row = mysqli_fetch_assoc($result_admin);
        $admin_email = $admin_row['email'];
    } else {
        echo "Error fetching admin email: " . mysqli_error($con);
        exit;
    }

    // Update email configuration (SMTP details)
    $mail = new PHPMailer(true); // Passing `true` enables exceptions

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
        $mail->setFrom($admin_email, 'Garbage Complaint System');
        $mail->addAddress($to, $name); // Add a recipient

        //Content
        $mail->isHTML(false); // Set email format to plain text
        $mail->Subject = $subject;
        $mail->Body    = $message;

        // Update feedback status
        $sql = "UPDATE feedback SET status = 1 WHERE id = $id";
        
        // Send email and update database
        if ($mail->send() && mysqli_query($con, $sql)) {
            echo '<script>alert("Message Sent.")</script>';
            echo '<script>window.location.href = "dashboard.php";</script>';
        } else {
            echo '<script>alert("Error Sending Message. Please try again later.")</script>';
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
