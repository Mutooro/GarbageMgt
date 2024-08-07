

<nav class="bg-gray-100 sticky top-0">
  <div class="max-w-6xl mx-auto px-4">
    <div class="flex justify-between">
      <div class="">
        <a href="index.php" class="flex items-center py-5 px-2 text-gray-700 hover:text-gray-900">
          <span class="font-bold">Plastic management system</span>
        </a>
      </div>

      <div class="flex space-x-4">
        <!-- primary nav -->
        <div class="hidden md:flex items-center space-x-1">
  <a href="index.php" class="py-5 px-3 text-gray-700 hover:text-blue-600">
    <i class="fas fa-house fa-fw"></i> Home
  </a>
  <a href="#about" class="py-5 px-3 text-gray-700 hover:text-blue-600">
    <i class="fas fa-book fa-fw"></i> About
  </a>
  <a href="#contact" class="py-5 px-3 text-gray-700 hover:text-blue-600">
    <i class="fas fa-envelope fa-fw"></i> Contact
  </a>

  <!-- Dropdown container -->
  <div class="relative">
    <button class="py-5 px-3 text-gray-700 hover:text-blue-600 focus:outline-none">
      <i class="fas fa-sign-in-alt fa-fw"></i> Login <i class="fas fa-chevron-down ml-1"></i>
    </button>
    <div class="absolute hidden mt-2 bg-white shadow-lg rounded-lg py-2 w-48 z-10">
      <a href="./admin/alogin.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-100 hover:text-blue-600">
        <i class="fas fa-user-cog fa-fw"></i> Admin
      </a>
      <a href="./driver/dlogin.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-100 hover:text-blue-600">
        <i class="fas fa-truck fa-fw"></i> Driver
      </a>
      <a href="./user/ulogin.php" class="block px-4 py-2 text-gray-800 hover:bg-blue-100 hover:text-blue-600">
        <i class="fas fa-user fa-fw"></i> User
      </a>
    </div>
  </div>
</div>

<script>
  // JavaScript to handle dropdown functionality
  document.addEventListener("DOMContentLoaded", function() {
    const dropdownToggle = document.querySelector('.relative');
    const dropdownMenu = dropdownToggle.querySelector('.absolute');

    dropdownToggle.addEventListener('click', function() {
      dropdownMenu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside of it
    document.addEventListener('click', function(event) {
      if (!dropdownToggle.contains(event.target)) {
        dropdownMenu.classList.add('hidden');
      }
    });
  });
</script>


      </div>

      <!-- mobile button goes here -->
      <div class="md:hidden flex items-center ">
        <button class="mobile-menu-button">
          <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
  <!-- mobile menu -->
  <div class="mobile-menu md:hidden hidden pb-2 transition-all duration-300 border-none z-10 sidebar">
    <a href="index.php" class="block py-2 px-4 text-sm hover:bg-gray-200"><i class="fa-solid fa-house"></i> Home</a>
    <a href="#about" class="block py-2 px-4 text-sm hover:bg-gray-200"><i class="fa-solid fa-book"></i> About</a>
    <a href="#contact" class="block py-2 px-4 text-sm hover:bg-gray-200"><i class="fa-solid fa-envelope"></i> Contact</a>
    <a href="./admin/alogin.php" class="block py-2 px-4 text-sm hover:bg-gray-200"><i class="fa-regular fa-id-card"></i> Admin</a>
    <a href="./driver/dlogin.php" class="block py-2 px-4 text-sm hover:bg-gray-200"><i class="fa-solid fa-car-side"></i> Driver</a>
    <a href="./user/ulogin.php" class="block py-2 px-4 text-sm hover:bg-gray-200"><i class="fa-solid fa-user"></i> User</a>
  </div>
</nav>
<script>
  // grab everything we need
  const btn = document.querySelector("button.mobile-menu-button");
  const menu = document.querySelector(".mobile-menu");

  // add event listeners
  btn.addEventListener("click", () => {
    menu.classList.toggle("hidden");
  });
</script>