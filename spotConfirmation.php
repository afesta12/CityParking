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
    <main class="flex flex-col items-center justify-center h-screen w-screen bg-green-200">
        <div class="flex flex-col bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <img src="/images/wondervilleLogo.png" alt="Logo for Wonderville Parking">
            <?php
                $confNum = $_SESSION["confNum"];
                echo "<p class='text-lg font-semibold mb-4 text-center'>Spot reserved. <br> Your confirmation number is $confNum.</p>";
            ?>
            <a href="/index.php" class="w-26 text-center text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                Return To Home
            </a>
        </div>
    </main>
</body>
</html>
