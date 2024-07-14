<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project_gcs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from both driver and admin tables
$sql = "(SELECT driver_name as name, driver_picture as picture_url, 'Driver' as role FROM drivers)
        UNION
        (SELECT name, picture as picture_url, 'Admin' as role FROM admin)";

$result = $conn->query($sql);

$team_members = array();

if ($result->num_rows > 0) {
    // Fetch all rows and store them in an array
    while ($row = $result->fetch_assoc()) {
        $team_members[] = $row;
    }
} else {
    echo "No team members found.";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plastic management system</title>
    <script src="https://kit.fontawesome.com/62f9066fa7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-9I3QJCKMA8JYLjRYbKuUzQ1VpKZkMZb5K01BRFz9Z2hH6rNK8i3h9k+hq3TbHTvP+0+KX5Hc/L33aVn2gG1eTQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php include('./layout/header.php') ?>
    <section class="bg-gradient-to-r from-red-200 to-indigo-300 h-screen flex justify-center items-center">
        <div class="container flex flex-col md:flex-row items-center">
            <div class="flex flex-col w-full lg:w-1/2  p-5 justify-center items-center">
                <div class="flex flex-col justify-center items-center h-full ">
                    <h1 class="block font-bold text-3xl my-4">Welcome to the Plastic management System</h1>
                    <p class="leading-normal mb-4"> A modern way to manage garbage Complaint, collection and disposal.</p>
                </div>

                <div class="mt-5 flex justify-center">
                    <div class="inline-flex rounded-md shadow">
                        <a href="./user/uregister.php" class="px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-500 hover:bg-green-600">
                            Get Started
                        </a>
                    </div>
                    <div class="ml-3 inline-flex">
                        <a href="#about" class="px-5 py-3 border border-transparent text-base font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/2 lg:py-6 text-center p-5 lg:mt-5">
                <img src="images/main.png" alt=" " class="w-full object-cover">
            </div>
        </div>
    </section>
    <section id="services" class="pt-10 lg:pt-32 pb-12 lg:pb-24 bg-gradient-to-r from-green-200 to-violet-300 ">
        <div class="py-24 md:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:text-center">
                    <h2 class="text-base font-semibold leading-7 text-indigo-600">Key Features</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 md:text-4xl">Everything you need for a Garbage Complaint System</p>
                </div>
                <div class="mx-auto mt-16 max-w-2xl md:mt-20 lg:mt-24 lg:max-w-4xl">
                    <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                        <div class="pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-app-window text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z"></path>
                                        <path d="M6 8h.01"></path>
                                        <path d="M9 8h.01"></path>
                                    </svg>
                                </div>
                                User-friendly Interface
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">An intuitive and easy-to-use interface for submitting and managing garbage Complaints.</dd>
                        </div>
                        <div class="pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-google-analytics text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10 9m0 1.105a1.105 1.105 0 0 1 1.105 -1.105h1.79a1.105 1.105 0 0 1 1.105 1.105v9.79a1.105 1.105 0 0 1 -1.105 1.105h-1.79a1.105 1.105 0 0 1 -1.105 -1.105z"></path>
                                        <path d="M17 3m0 1.105a1.105 1.105 0 0 1 1.105 -1.105h1.79a1.105 1.105 0 0 1 1.105 1.105v15.79a1.105 1.105 0 0 1 -1.105 1.105h-1.79a1.105 1.105 0 0 1 -1.105 -1.105z"></path>
                                        <path d="M5 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                    </svg>
                                </div>
                                Real-time Complaint Tracking
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">Track the status and progress of your garbage Complaints in real-time.</dd>
                        </div>
                        <div class=" pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                </div>
                                Efficient Plastic Management
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">Effectively manage garbage collection and disposal based on the received Complaints.</dd>
                        </div>
                        <div class="pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="left-0 top-0 flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail-check text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M11 19h-6a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"></path>
                                        <path d="M3 7l9 6l9 -6"></path>
                                        <path d="M15 19l2 2l4 -4"></path>
                                    </svg>
                                </div>
                                Automated Notifications
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">Receive automated notifications and updates regarding your garbage Complaints.</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="bg-sky-200">
        <main class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-12 text-lg">
            <div class="container mx-auto px-4 py-8">
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-1/2">
                        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 lg:mb-6">
                            About Plastic management  System
                        </h1>
                        <p class="text-lg leading-7 text-gray-700 mb-4">
                            Welcome to the Garbage Complaint System! We are committed to creating a cleaner and more sustainable environment by addressing the issue of garbage disposal. Our platform serves as a dedicated space for individuals and communities to voice their concerns regarding waste management and work towards effective solutions.
                        </p>
                        <p class="text-lg leading-7 text-gray-700 mb-4">
                            We provide a wide range of services, including residential waste collection, recycling, and composting. Our team of trained professionals is dedicated to delivering excellent customer service and ensuring that all waste materials are properly handled and disposed of.
                        </p>
                        <p class="text-lg leading-7 text-gray-700 mb-4">
                            At Garbage Complaint System, we are committed to sustainability and reducing our carbon footprint. We continuously seek ways to improve our operations and minimize our impact on the environment.
                        </p>
                    </div>
                    <div class="lg:w-1/2 lg:pl-10 mt-8 lg:mt-0">
                        <img class="block mx-auto rounded-md shadow-md" src="images/gtruck1.avif" alt="Garbage Collection System truck">
                    </div>
                </div>
            </div>

            <div class="mt-12">
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 lg:mb-6">
            Our Team
        </h1>
        <p class="mt-4 leading-7 text-gray-700">
            Our team is made up of experienced professionals who are passionate about waste management and sustainability. We believe that our team is our most valuable asset, and we invest in their training and development to ensure that they have the knowledge and skills to provide the best service to our customers.
        </p>
        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($team_members as $member): ?>
                <div class="text-white card mx-auto bg-sky-300 rounded-lg max-w-md w-full">
                    <br>
                    <img class="w-32 mx-auto rounded-full" src="admin/<?php echo $member['picture_url']; ?>" alt="<?php echo $member['name']; ?>">

                    <div class="text-center mt-2 text-3xl font-medium"><?php echo $member['name']; ?></div>
                    <div class="px-6 py-5 text-center mt-2 font-semibold text-md"><?php echo $member['role']; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

            <div class="mt-12">
                <h2 class="text-xl lg:text-2xl font-bold text-gray-900">Our Mission</h2>
                <p class="mt-4 leading-7 text-gray-700">
                    Our mission is to empower individuals and communities to take action against improper garbage disposal. We believe that everyone has the right to live in a clean and healthy environment, and we strive to facilitate positive change through a user-friendly and accessible platform.
                </p>
            </div>
        </main>
    </section>
    <section id="contact" class="pt-12 bg-gray-300 z-40">
        <div class="h-screen">
            <div class="flex flex-col items-center h-full justify-center px-4 md:px-0">
                <div class="flex flex-col md:flex-row rounded-lg w-full md:w-3/4 lg:w-10/12 md:mx-0">
                    <div class="md:w-1/2 md:h-full flex items-center justify-center">
                        <div class="w-full flex flex-col text-center rounded-lg p-6 md:p-10">
                            <div class="w-full mx-auto mb-6 flex">
                                <div class="w-1/2">
                                    <i class="text-5xl fas fa-location-dot"></i>
                                </div>
                                <div class="text-left">
                                    <h4 class="text-2xl font-bold">Our Location</h4>
                                    <p class="text-gray-600">Makerere, Kampala</p>
                                </div>
                            </div>
                            <div class="w-full mx-auto mb-6 flex">
                                <div class="w-1/2">
                                    <i class="text-5xl fas fa-phone"></i>
                                </div>
                                <div class="text-left">
                                    <h4 class="text-2xl font-bold">Call Us</h4>
                                    <p class="text-gray-600">+256707064552</p>
                                </div>
                            </div>
                            <div class="w-full mx-auto flex">
                                <div class="w-1/2">
                                    <i class="text-5xl fas fa-envelope"></i>
                                </div>
                                <div class="text-left">
                                    <h4 class="text-2xl font-bold">Email Us</h4>
                                    <p class="text-gray-600">info@gcs.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col w-full md:w-1/2 p-4">
                        <div class="flex flex-col flex-1 justify-center mb-8">
                            <div class="mb-4">
                                <h6 class="text-gray-600 uppercase font-bold mb-2">Need Help?</h6>
                                <h1 class="text-4xl font-bold">Send Us A Message</h1>
                            </div>
                            <div class="w-full mt-4">
                                <form class="form-horizontal mx-auto" method="POST" action="">
                                    <div class="mb-6">
                                        <input type="text" class="w-full shadow-md border-1 border-gray-400 rounded-md py-2 px-4 placeholder-gray-400 focus:outline-none focus:border-blue-500 bg-white-100" placeholder="Your Name" name="name" required="required">
                                    </div>
                                    <div class="mb-6">
                                        <input type="email" class="w-full shadow-md border-1 border-gray-400 rounded-md py-2 px-4 placeholder-gray-400 focus:outline-none focus:border-blue-500" placeholder="Your Email" name="email" required="required">
                                    </div>
                                    <div class="mb-6">
                                        <textarea class="w-full shadow-md border-1 border-gray-400 rounded-md py-2 px-4 placeholder-gray-400 focus:outline-none focus:border-blue-500" rows="5" placeholder="Message" name="message" required="required"></textarea>
                                    </div>
                                    <div class="w-full text-center">
                                        <input type="submit" name="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-md">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    include('./layout/footer.php');
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $con = mysqli_connect('localhost', 'root', '', 'project_gcs');
        $sql = "INSERT INTO feedback(name,email,message) VALUES('$name','$email','$message')";
        if (mysqli_query($con, $sql)) {
            echo '<script>alert("Message Submited.")</script>';
        } else {
            echo '<script>alert("Error submitting, Please try again.")</script>';
        }
    }

    ?>
</body>