<!-- Start session -->
<?php 
    session_start();
    include("database.php");
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
    <main class="flex flex-col items-center h-screen w-screen bg-green-200">
        <!-- Spot reservation  -->
        <form action="reserveSpot.php" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <img src="/images/wondervilleLogo.png" alt="" style="display: block; margin: auto;">
            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name">
            </div>
            <!-- Cellphone -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cellphone">
                    Cellphone #
                </label>
                <input name="cellphone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="cellphone" type="text" placeholder="Cellphone #">
            </div>
            <!-- Date -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Reservation Date
                </label>
                <input name="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="date" type="date" placeholder="Reservation Date">
            </div>
            <!-- Save above info into session variables, next page to search for spots -->
            <div class="flex items-center justify-center mb-4">
                <button name="zones" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                    Search Available Zones
                </button>
            </div>
            <div class="flex items-center justify-center mb-4">
                <button name="distance" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                    Search Distance Between Zones and Venues
                </button>
            </div>
        </form>
    </main>
</body>
</html>

<?php 
    if(isset($_POST["zones"]) || isset($_POST["distance"])){
        if (empty($_POST["date"]) || empty($_POST["cellphone"]) || empty($_POST["name"])) {
        
            echo '<script>alert("No field can be left blank.")</script>';
        }
        else {
            $_SESSION["cellphone"] = $_POST["cellphone"];
            $_SESSION["date"] = $_POST["date"];
            $_SESSION["name"] = $_POST["name"];
            $dateStr =  $_POST["date"];

            $date = new DateTime($_POST["date"]);
            $currDate = new DateTime(date("y-m-d"));

            // check number of lots that have selected date
            $sql = "SELECT count(*) FROM lot WHERE Date = '$dateStr'";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();
            $dateCount = $row['count(*)'];

            // if date current date ...
            if ($date == $currDate) {
                // cannot reserve
                echo '<script>alert("Reservation must be made at least 1 day ahead.")</script>';
            }
            // if lot does not reserve spots that date ...
            else if ($dateCount == 0) {
                // cannot reserve
                echo '<script>alert("No lot reserves spots this date.")</script>';
            }
            else {
                if(isset($_POST["zones"])) {header("Location: zoneSpotResults.php");}
                else {header("Location: distSpotResults.php");}
                
            }
        }
    }
?>
