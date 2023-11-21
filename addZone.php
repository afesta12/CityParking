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
    
    <main class="flex flex-col items-center justify-center h-screen w-screen bg-green-200">
        <!-- Spot reservation  -->
        <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <img src="/images/wondervilleLogo.png" alt="">
            <!-- Zone name -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Zone name
                </label>
                <input name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Zone Name">
            </div>

            <!-- Capacity -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="capacity">
                    Zone Capacity
                </label>
                <input name="capacity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="cellphone" type="text" placeholder="Capacity">
            </div>

            <!-- Date -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Event Date
                </label>
                <input name="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="date" type="date" placeholder="Reservation Date">
            </div>

            <!-- Available spaces -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="space">
                    Number of Spots Reservable
                </label>
                <input name="space" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="cellphone" type="text" placeholder="Capacity">
            </div>

            <!-- Rate -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="rate">
                    Spot Rate
                </label>
                <input name="rate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="cellphone" type="text" placeholder="Capacity">
            </div>

            <div class="flex items-center justify-center">
                <button name="add" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                    Add Zone
                </button>
            </div>
        </form>
    </main>
</body>
</html>

<?php 

    // Add
    if(isset($_POST["add"])){

        // Check empty fields
        if (empty($_POST["name"]) || empty($_POST["capacity"])) {
        
            echo '<script>alert("Zone name or capacity left empty.")</script>';
            
        } else {

            // Variables
            $zoneName = $_POST["name"];
            $capacity = $_POST["capacity"];
            $date = $_POST["date"];
            $space = $_POST["space"];
            $rate = $_POST["rate"];
            $table = "Lot_Info";

            // Query / connection
            $sql = "INSERT INTO $table (ZoneName, Capacity) VALUES ('$zoneName', $capacity)";
            $connection->query($sql);

            // Get zone number
            $zoneNumberQuery = "SELECT ZoneNumber FROM $table WHERE ZoneName = '$zoneName'";
            $res = $connection->query($zoneNumberQuery);
            $value = $res->fetch_assoc();
            $number = $value["ZoneNumber"];

            // Insert into lot
            $lotSql = "INSERT INTO lot VALUES ('$number', '$date', '$space', '$rate')";
            $connection->query($lotSql);

            // Alert -> wait -> redirect so alert visible
            if ($connection) {

                echo "<script>alert('$zoneName added')</script>";
                echo "<script>window.location.href='addZone.php';</script>";
            } else {

                echo "<script>alert('Error adding zone.')</script>";
                echo "<script>window.location.href='addZone.php';</script>";
            }
        }
    }
?>