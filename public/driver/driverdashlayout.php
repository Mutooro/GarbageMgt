<?php
session_start();
if (!isset($_SESSION['drivername'])) {
    header('location:dlogin.php');
}
$driver = $_SESSION['drivername'];
$email = $_SESSION['driveremail'];
$driverid = $_SESSION['driverid'];

$con = mysqli_connect("localhost", "root", "", "project_gcs");
if ($con === false) {
    die("Error connection ");
}
$qry = "SELECT * FROM drivers where driver_id = $driverid";
$result = mysqli_query($con, $qry);
$data = mysqli_fetch_assoc($result);
?>
<div class="flex">
    <div class="fixed h-screen flex flex-col w-14 hover:w-64 md:w-64 bg-violet-500 text-white transition-all duration-300 border-none z-10 sidebar">
        <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
            <div class="fixed w-full flex items-center h-14 text-white z-10">
                <div class="flex items-center pl-3 w-14 md:w-64 h-24 bg-gray-800 border-none">
                    <a href="editprofile.php">
                        <img class="mt-2 mr-2 h-16 w-16 md:w-10 md:h-10  overflow-hidden object-cover rounded-md" src="<?php echo $data['driver_picture'] ?>" onerror="this.src='profilepic/dummyuser.jpg';" />

                    </a> <span class="hidden md:block border-b-2 border-blue-400 "><?php echo $driver; ?> </span>
                </div>
            </div>
            <ul class="flex flex-col mt-20 py-4 space-y-1">

                <li class="px-5 hidden md:block">
                    <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-light tracking-wide text-white uppercase">
                            Main
                        </div>
                    </div>
                </li>
                <li>
                    <a href="driverdashboard.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                    </a>
                </li>
                <?php
                $count = "SELECT * FROM notification WHERE to_id =$driverid AND status=0";
                $res = mysqli_query($con, $count);
                $c = mysqli_num_rows($res);
                ?>

                <li>
                    <a href="notification.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
                        <?php if ($c != 0) { ?>
                            <div class="absolute left-0 top-0  bg-red-500 rounded-full">
                                <span class="text-sm text-white p-2"><?php echo $c; ?></span>
                            </div>
                        <?php } ?>
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
                                <path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Notifications</span>
                    </a>
                </li>
                <li>
                    <a href="assignedtask.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Assigned Task</span>
                    </a>

                </li>
                <li>
                    <a href="workhistory.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">History</span>
                    </a>
                </li>
                <li class="px-5 hidden md:block">
                    <div class="flex flex-row items-center mt-5 h-8">
                        <div class="text-sm font-light tracking-wide text-white uppercase">
                            Settings
                        </div>
                    </div>
                </li>
                <li>
                    <a href="editprofile.php" class="relative flex flex-row items-center h-11 focus:outline-none  hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Profile</span>
                    </a>
                </li>
                <li>
                    <a href="dchangepass.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Settings</span>
                    </a>
                </li>
                <li>
                    <a onclick="showLogout();" class="text-white hover:bg-gray-600 px-3 py-2 rounded-md cursor-pointer flex items-center">
                        <!-- <i class="fas fa-sign-out-alt mr-2"></i> -->
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate"> Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div id="logoutbox" class="hidden fixed inset-0 bg-opacity-40 backdrop-blur-sm">
    <div class="flex h-full justify-center items-center">
        <div class="flex flex-col p-10 rounded-lg shadow bg-white">
            <div class="text-center">
                <h2 class="font-semibold text-gray-800">Are you sure you want to log out?</h2>
            </div>
            <div class="flex items-center mt-6">
                <button onclick="hideLogout()" class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
                    Cancel
                </button>
                <a href="" id="confirmLogout" class="flex-1 px-4 py-2 ml-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-md text-center">
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('mobile-menu-toggle').addEventListener('click', function() {
        var menuItems = document.querySelector('ul');
        menuItems.classList.toggle('hidden');
    });
</script>
<script>
    function showLogout() {
        document.getElementById("logoutbox").style.display = "block";
        // Adjust the logout link as needed
        document.getElementById('confirmLogout').href = "../driver/dlogout.php";
    }

    function hideLogout() {
        document.getElementById("logoutbox").style.display = "none";
    }
</script>