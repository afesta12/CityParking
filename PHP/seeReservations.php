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
                    <li><a href="/PHP/index.php" class="hover:underline hover:underline-offset-4">Home</a></li>
                    <li><a href="/PHP/seeReservations.php" class="hover:underline hover:underline-offset-4">Your Reservations</a></li>
                    <li><a href="/PHP/adminLogin.php" class="hover:underline hover:underline-offset-4">Admin Login</a></li>
                </ul>
            </nav>
        </div>
</header>
    <main class="flex flex-col items-center h-screen w-screen bg-green-200">
        <!-- See reservations  -->
        <form action="seeReservations.php" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <img src="/PHP/images/wondervilleLogo.png" alt="">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cellphone">
                    Cellphone #
                </label>
                <input name="cellphone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="cellphone" type="text" placeholder="Cellphone #">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="confirmation">
                    Confirmation #
                </label>
                <input name="confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="confirmation" type="text" placeholder="Confirmation #">
            </div>
            <div class="flex items-center justify-between">
                <button name="search" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                    Search Reservations
                </button>
            </div>
        </form>
    </main>

</body>
</html>

<?php 
    if(isset($_POST["search"])){
        if (empty($_POST["cellphone"]) && empty($_POST["confirmation"])) {
        
            echo '<script>alert("A cellphone or confirmation number must be entered.")</script>';
        }

        else {
            $_SESSION["cellphone"] = $_POST["cellphone"];
            $_SESSION["confirmation"] = $_POST["confirmation"];
    
            header("Location: /PHP/reservationResults.php");
        }        
    }
?>
