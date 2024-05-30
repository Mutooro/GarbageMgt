<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../style.css">
    <script>
        function validate() {
            var name = document.forms["form"]["name"].value;
            var email = document.forms["form"]["email"].value;
            var photo = document.forms["form"]["photo"].value;

            // Check if Email is valid
            var emailRegex = /^[A-Za-z\._\-0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Check if Photo is selected
            if (photo === '') {
                alert("Please select a profile picture.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <div class="flex">
        <?php include('dashlayout.php'); ?>
        <?php
        $qry = "SELECT * FROM admin";
        $result = mysqli_query($con, $qry);
        $data = mysqli_fetch_assoc($result);
        $pic = $data['picture'];
        $profile_pic = basename($pic);
        ?>
        <div class="h-full w-full p-5 ml-14 md:ml-64 ">
            <div class="w-full">
                <h2 class="text-3xl border-b-2 border-blue-600">Change Profile</h2>
            </div>
            <div class="flex justify-center">
                <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
                    <form name="form" class="px-8 pb-8 mb-4 bg-white rounded" method="post" action="" onsubmit="return validate();" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="name">
                                Name
                            </label>
                            <input value="<?php echo $data['name'];?>" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="name" name="name" placeholder="Name" type="text" required />
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                Email
                            </label>
                            <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="email" value="<?php echo $data['email']; ?>" name="email" type="email" placeholder="Email" required />
                        </div>
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                Profile Picture
                            </label>
                            <div class="w-full h-1/2 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none">
                         </div>
                            <input class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" type="file" name="photo" id="uploadfile" value="<?php echo $profile_pic ;?>" >
                        </div>
                        <div class="mb-6 text-center">
                            <input type="submit" value="Update Profile" class="btn w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700" name="updateprofile" onclick="return confirm('Are You Sure To Edit Profile ?')">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>                                <img src="<?php echo $data['picture']; ?>" alt="">
   

</html>

<?php
if (isset($_POST['updateprofile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0)
    {
        $filename = $_FILES["photo"]["name"];
        $tempname = $_FILES["photo"]["tmp_name"];
        $folder = "profilepic/" . $filename;
        move_uploaded_file($tempname, $folder);
    
        $qry = "UPDATE admin SET name='$name',email = '$email',picture='$folder' WHERE id=1 ";
        if ($reslt = mysqli_query($con, $qry)) {
    
            echo '<script> alert("Profile Picture Changed Sucessfully."); </script> ';
            echo '<script>window.location.href = "dashboard.php";</script>';
        } else {
            echo '<script> alert("Unable to Update Profile"); </script> ';
        }
    }
    else{
        $qry = "UPDATE admin SET name='$name',email = '$email' WHERE id=1 ";
        if ($reslt = mysqli_query($con, $qry)) {
    
            echo '<script> alert("Profile Updated Sucessfully,Session Expired!!!"); </script> ';
            session_unset();
            session_destroy();
            echo '<script>window.location.href = "alogin.php";</script>';
        } else {
            echo '<script> alert("Unable to Update Profile"); </script> ';
        }

    }
 
}
?>
</body>

</html>