<!-- Start session -->
<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Parking</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header class="bg-emerald-400 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">Wonderville Parking</div>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="/index.php" class="hover:underline hover:underline-offset-4">Home</a></li>
                    <li><a href="/seeReservations.php" class="hover:underline hover:underline-offset-4">Your Reservations</a></li>
                    <li><a href="/adminLogin.php" class="hover:underline hover:underline-offset-4">Admin Login</a></li>
                </ul>
            </nav>
        </div>
</header>
    <main class="flex flex-col items-center justify-center h-screen w-screen bg-green-200">
        <!-- Admin login  -->
        <form action="adminlogin.php" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <img src="/images/wondervilleLogo.png" alt="">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="Password">
            </div>
            <div class="flex items-center justify-between">
                <button name="login" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                    Sign In
                </button>
            </div>
        </form>
    </main>
</body>
</html>

<?php 

    // Admin login
    if(isset($_POST["login"])){

        // Check empty fields
        if (empty($_POST["username"]) || empty($_POST["password"])) {
        
            echo '<script>alert("Username or password field left blank.")</script>';
        }

        // Check correct credentials -> set credentials if correct
        if ($_POST["username"] != "admin" || $_POST["password"] != "admin123") {

            echo '<script>alert("Incorrect username or password entered.")</script>';
        } else {

            $_SESSION["username"] = $_POST["username"];
            $_SESSION["password"] = $_POST["password"];

            // Redirect to admin dashboard
            header("Location: admin.php");
        }
    }
?>