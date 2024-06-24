<div class="bg-gray-800">
    <div class="container mx-auto px-4">
        <nav class="flex items-center justify-between h-16">
            <!-- Logo or Brand -->
            <div class="flex-shrink-0">
                <a href="#" class="text-white text-lg font-semibold">Your Logo</a>
            </div>
            
            <!-- Menu Items -->
            <ul class="hidden md:flex flex-row items-center space-x-4">
                <li>
                    <a href="#" class="text-white hover:bg-gray-600 px-3 py-2 rounded-md">Home</a>
                </li>
                <li>
                    <a href="editprofile.php" class="text-white hover:bg-gray-600 px-3 py-2 rounded-md">Profile</a>
                </li>
                <li>
                    <a href="changepassword.php" class="text-white hover:bg-gray-600 px-3 py-2 rounded-md">Settings</a>
                </li>
                <li>
                    <a onclick="showLogout();" class="text-white hover:bg-gray-600 px-3 py-2 rounded-md cursor-pointer flex items-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </a>
                </li>
            </ul>
            
            <!-- Hamburger Menu for Mobile -->
            <div class="md:hidden">
                <button id="mobile-menu-toggle" class="text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>
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
