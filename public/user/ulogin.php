<?php
session_start();
if (isset($_SESSION['username'])) {
  header('location:userdashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login</title>
  <link rel="stylesheet" href="../style.css" />
</head>

<body>
  <div class="bg-gray-400 h-screen w-screen">
    <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
      <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0" style="height: 500px">
        <div class="flex flex-col w-full md:w-1/2 p-4 bg-purple-300">
          <div class="flex flex-col items-center justify-center mb-8">
          <img src="../images/adminlog.jpg" alt="adminlogo" class="w-32 mx-auto rounded-lg">
          <h1 class="text-2xl font-bold mt-2">Log In to continue</h1>
            <div class="w-full mt-4">
              <form class="form-horizontal w-3/4 mx-auto" method="POST" action="">
                <div class="flex flex-col mt-4">
                  <input id="name" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="user" placeholder="Name" />
                </div>
                <div class="flex flex-col mt-4">
                  <input id="email" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="uemail" placeholder="Email" />
                </div>
                <div class="flex flex-col mt-4">
                  <input id="password" type="password" class="flex-grow h-8 px-2 rounded border border-grey-400" name="password" required placeholder="Password" />
                </div>
                <div class="flex flex-col mt-8">
                  <input type="submit" value="Login" name="login" class="bg-blue-500 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-4 rounded" />
                </div>
              </form>
              <div class="text-center mt-4">
                <a class="no-underline hover:underline text-blue-dark text-xs" href="uregister.php">
                  Register here ?
                </a>
              </div>
              <div class="text-center mt-2">
                <a class="text-blue-dark text-xs" href="../index.php">
                  Back?
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class=" md:block md:w-1/2 rounded-r-lg " style="background:url('welcome.png'); background-size:cover; background-position:center;">
        </div>
      </div>
    </div>
  </div>

</body>

</html>
<?php
if (isset($_POST['login'])) {
  $con = mysqli_connect("localhost", "root", "", "project_gcs");
  if ($con === false) {
    die("Error connection ");
  }
  $user = $_POST['user'];
  $useremail = $_POST['uemail'];
  $pass = $_POST['password'];
  $sql = "SELECT * FROM users WHERE user_name = '$user' AND email='$useremail' AND password=md5('$pass')";
  if ($r = mysqli_query($con, $sql)) {
    if (mysqli_num_rows($r) > 0) {
      $_SESSION['username'] = $user;
      $_SESSION['user_email'] = $user;
      header('location:userdashboard.php');
    } else {
      echo '<script> alert("Invalid Username or Password"); </script> ';
    }
  }
}
?>