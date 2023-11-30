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
<header class="bg-emerald-400 p-4 text-white">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">Wonderville Parking</div>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="index.php" class="hover:underline hover:underline-offset-4">Home</a></li>
                    <li><a href="seeReservations.php" class="hover:underline hover:underline-offset-4">Your Reservations</a></li>
                    <li><a href="adminLogin.php" class="hover:underline hover:underline-offset-4">Admin Login</a></li>
                </ul>
            </nav>
        </div>
</header>
<body>  
    <main class="flex flex-col items-center h-screen w-screen bg-green-200">
        <div class="flex flex-col items-center bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <img class="h-32 w-32" src="images/wondervilleLogo.png" alt="Logo for Wonderville Parking">
            <?php
                $confNum = $_SESSION["confNum"];
                echo "<p class='text-lg font-semibold mb-4 text-center'>Spot reserved. <br> Your confirmation number is $confNum.</p>";
            ?>
            <a href="index.php" class="w-26 text-center text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                Return To Home
            </a>
        </div>
    </main>
</body>
</html>
