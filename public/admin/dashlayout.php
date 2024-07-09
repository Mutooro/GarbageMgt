<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header('location:alogin.php');
}
?>
<?php
$con = mysqli_connect("localhost", "root", "", "project_gcs");
if ($con === false) {
    die("Error connection ");
}
$qry = "SELECT * FROM admin";
$result = mysqli_query($con, $qry);
$data = mysqli_fetch_assoc($result);
?>
<script src="https://kit.fontawesome.com/62f9066fa7.js" crossorigin="anonymous"></script>
<div class="flex">
    <div class="fixed h-screen flex flex-col w-14 hover:w-64 md:w-64 bg-sky-600 text-white transition-all duration-300 border-none z-10 ">
        <div class="flex flex-col justify-between flex-grow">
            <div class="fixed w-full flex items-center h-14 text-white z-10">
            <div class="flex items-center justify-start pl-3 w-14 md:w-64 h-14 bg-gray-700 border-none">
    <a href="editprofile.php">
        <img class="w-7 h-7 md:w-10 md:h-10 mr-2 rounded-full overflow-hidden" src="../admin/<?php echo $data['picture'] ?>" />
    </a>
    <span class="hidden md:block"><?php echo $data['name'] ?></span>
</div>

            </div>
            <ul class="flex flex-col mt-10 py-4 space-y-1">
                <li class="px-5 hidden md:block">
                    <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-medium tracking-wide text-gray-800 uppercase">
                            Main
                        </div>
                    </div>
                </li>
                <li>
                    <a href="dashboard.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                    </a>
                </li>
                <?php
                $count = "SELECT * FROM notification WHERE to_id =1 AND status=0";
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
                    <a href="bins.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
                        <!-- <i class="ml-4 fa-sharp fa-solid fa-dumpster"></i> -->
                        <span class="inline-flex justify-center items-center ml-4">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>

                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Bins</span>
                    </a>
                </li>
                <li>
                    <a href="driver.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
                        <!-- <i class="ml-4 fa-solid fa-car-side"></i> -->
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M18 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M4 17h-2v-11a1 1 0 0 1 1 -1h14a5 7 0 0 1 5 7v5h-2m-4 0h-8"></path>
                                <path d="M16 5l1.5 7l4.5 0"></path>
                                <path d="M2 10l15 0"></path>
                                <path d="M7 5l0 5"></path>
                                <path d="M12 5l0 5"></path>
                            </svg>



                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate"> Drivers</span>
                    </a>
                </li>
                <li>
                    <a href="usercomplain.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">

                        <span class="inline-flex justify-center items-center ml-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 16v-4"></path>
                                <path d="M12 8h.01"></path>
                                <path d="M12 20h.01"></path>
                            </svg>
                        </span>

                        <span class="ml-2 text-sm tracking-wide truncate">User Complains</span>
                    </a>
                </li>
                <li>
                    <a href="complainhistory.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10s10-4.477 10-10c0-5.523-4.477-10-10-10zm0 18a8 8 0 100-16 8 8 0 000 16zm-2-9l4-4 4 4M10 8h4"></path>
                            </svg>

                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Complains History</span>
                    </a>
                </li>
                <li>
                    <a href="feedback.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
                        <?php
                        $count = "SELECT * FROM feedback WHERE status=0";
                        $res = mysqli_query($con, $count);
                        $c = mysqli_num_rows($res);
                        ?>
                        <?php if ($c != 0) { ?>
                            <div class="absolute left-0 top-0  bg-red-500 rounded-full">
                                <span class="text-sm text-white p-2"><?php echo $c; ?></span>
                            </div>
                        <?php } ?>
                        <span class="inline-flex justify-center items-center ml-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                            </svg>

                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Feedback</span>
                    </a>
                </li>
                <li>
                    <a href="changepassword.php" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-gray-600 text-white-600 hover:text-white-800 border-l-4 border-transparent hover:border-gray-800 pr-6">
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
        document.getElementById('confirmLogout').href = "../admin/logout.php";
    }

    function hideLogout() {
        document.getElementById("logoutbox").style.display = "none";
    }
</script>


