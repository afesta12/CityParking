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
                    <li><a href="#" class="hover:underline hover:underline-offset-4">Revenue Report</a></li>
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Zone name
                </label>
                <input name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Zone Name">
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

    // TODO: Add remove zone queries =)
    // Remove
    if(isset($_POST["remove"])){

        // Check empty fields
        if (empty($_POST["name"])) {
        
            echo '<script>alert("Zone name left empty.")</script>';
            
        } else {

            // Variables
            $zoneName = $_POST["name"];
            $table = "Lot_Info";

            // Query / connection
            $sql = "INSERT INTO $table (ZoneName, Capacity) VALUES ('$zoneName', $capacity)";
            $connection->query($sql);

            // Alert -> wait -> redirect so alert visible
            if ($connection) {

                echo "<script>alert('$zoneName removed.')</script>";
                echo "<script>window.location.href='removeZone.php';</script>";
            } else {

                echo "<script>alert('Error removing zone.')</script>";
                echo "<script>window.location.href='removeZone.php';</script>";
            }
        }
    }
?>