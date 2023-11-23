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
                    <li><a href="/addZone.php" class="hover:underline hover:underline-offset-4">Add Zone</a></li>
                    <li><a href="/removeZone.php" class="hover:underline hover:underline-offset-4">Remove Zone</a></li>
                    <li><a href="/updateZone.php" class="hover:underline hover:underline-offset-4">Update Zone</a></li>
                    <li><a href="/adminRevenue.php" class="hover:underline hover:underline-offset-4">Revenue Report</a></li>
                    <li><a href="/adminLogout.php" class="hover:underline hover:underline-offset-4">Logout</a></li>
                </ul>
            </nav>
        </div>
</header>
    <main class="flex flex-col items-center h-screen w-screen bg-green-200">
        <!-- Spot reservation  -->
        <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <img src="/images/wondervilleLogo.png" alt="">
            <!-- Zone name -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="number">
                    Zone Number
                </label>
                <input name="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Zone Name">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Date
                </label>
                <input name="date" type="date" class="mb-4 appearance-none border border-gray-300 rounded-md py-2 px-4 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
            </div>

            <div class="flex items-center justify-center">
                <button name="remove" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                    Remove Zone
                </button>
            </div>
        </form>
    </main>
</body>
</html>

<?php 

    // Remove
    if(isset($_POST["remove"])){

        // Check empty fields
        if (empty($_POST["number"])) {
        
            echo '<script>alert("Zone name left empty.")</script>';
            
        } else {

            // Variables
            $zoneNumber = $_POST["number"];
            $date = $_POST["date"];

            // Query / connection
            $sql = "SELECT count(*) 
                    from Reservation 
                    where 
                        ZoneNumber = '$zoneNumber' AND date = '$date' AND Status = 'Active'";
            $num = $connection->query($sql);

            if ($connection && $num->fetch_assoc()["count(*)"] == 0) {

                $sql = "UPDATE Lot
                        SET space = 0
                        WHERE ZoneNumber = '$zoneNumber' AND date = '$date'";

                echo "<script>alert('Zone $zoneNumber removed on date $date.')</script>";
                echo "<script>window.location.href='admin.php';</script>";
            } else {

                echo "<script>alert('Error removing zone.')</script>";
                echo "<script>window.location.href='removeZone.php';</script>";
            }
        }
    }
?>