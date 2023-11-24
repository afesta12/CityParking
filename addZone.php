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
    <!-- Header -->
    <header class="bg-emerald-400 p-4 text-white">
            <div class="container mx-auto flex justify-between items-center">
                <div class="text-2xl font-bold">Wonderville Parking</div>
                <nav>
                    <ul class="flex space-x-4">
                        <li><a href="/addZone.php" class="hover:underline hover:underline-offset-4">Add Zone</a></li>
                        <li><a href="/removeZone.php" class="hover:underline hover:underline-offset-4">Remove Zone</a></li>
                        <li><a href="/updateZone.php" class="hover:underline hover:underline-offset-4">Update Zone</a></li>
                        <li><a href="/adminRevenue.php" class="hover:underline hover:underline-offset-4">Revenue Report</a></li>
                        <li><a href="/adminLogout.php" class="hover:underline hover:underline-offset-4">Logout</a></li>
                    </ul>
                </nav>
            </div>
    </header>

    <!-- Main -->
    <main class="flex flex-col items-center h-screen w-screen bg-green-200">
        <!-- Spot reservation  -->
        <form action="" method="post" class="flex flex-col items-center justify-center bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <img class="h-32 w-32" src="/images/wondervilleLogo.png" alt="">

            <!-- Date -->
            <div class="mb-6 w-1/2">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Event Date
                </label>
                    <input name="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="date" type="date" placeholder="Reservation Date">
            </div>
            <!-- Main Column -->
            <div class="flex">

                <!-- Left column -->
                <div class="flex flex-col">
                    <!-- Zone name -->
                    <div class="mb-7 w-11/12">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Zone Name
                        </label>
                        <input name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Zone Name">
                    </div>

                    <!-- Capacity -->
                    <div class="mb-4 w-11/12">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="capacity">
                            Zone Capacity
                        </label>
                        <input name="capacity" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Capacity">
                    </div>

                    <!-- Available spaces -->
                    <div class="mb-4 w-11/12">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="space">
                            Number of Spots Reservable
                        </label>
                        <input name="space" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"  type="text" placeholder="Reservable Spaces">
                    </div>
                </div>
                <!-- Right column -->
                <div class="flex flex-col">
                    <!-- Rate -->
                    <div class="mb-4 w-11/12">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="rate">
                            Spot Rate
                        </label>
                        <input name="rate" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Rate">
                    </div>

                    <!-- Venue Name -->
                    <div class="mb-4 w-11/12">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="venueName">
                            Venue Name
                        </label>
                        <input name="venueName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Venue Name">
                    </div>

                    <!-- Distance -->
                    <div class="mb-4 w-11/12">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="distance">
                            Distance to Venue
                        </label>
                        <input name="distance" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="Distance to Venue">
                    </div>
                </div>
            </div>
            
            <!-- Add Zone button -->
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
            $venueName = $_POST["venueName"];
            $distance = $_POST["distance"];
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

            // Insert into venue
            $venueSql = "INSERT INTO venue (VName) VALUES ('$venueName')";
            $connection->query(($venueSql));

            // Get venue number
            $venueNumberQuery = "SELECT VNumber FROM Venue WHERE VName = '$venueName'";
            $res = $connection->query($venueNumberQuery);
            $value = $res->fetch_assoc();
            $vNumber = $value["VNumber"];

            // Insert into distance
            $distanceSql = "INSERT INTO distance VALUES ('$number', '$vNumber', '$distance')";
            $connection->query($distanceSql);

            // Alert -> wait -> redirect so alert visible
            if ($connection) {

                echo "<script>alert('$zoneName added')</script>";
                echo "<script>window.location.href='admin.php';</script>";
            } else {

                echo "<script>alert('Error adding zone.')</script>";
                echo "<script>window.location.href='addZone.php';</script>";
            }
        }
    }
?>