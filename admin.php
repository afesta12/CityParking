<!-- Start session -->
<?php

    // buffer output to avoid header error
    ob_start();
    session_start();

    // Include database file
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

    <!-- Date picker CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/datepicker.min.js"></script>
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
    <main class="flex flex-col items-center  h-screen w-screen bg-green-200">

        <div class="flex flex-col bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="flex justify-center">
                <img class="h-32 w-32" src="/images/wondervilleLogo.png" alt="">
            </div>

            <form action="" method="post" class="flex-col bg-white rounded px-8 pt-6 pb-8 mb-4">
                <div class="flex justify-evenly">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="start">
                            Start Date
                        </label>
                        <input name="start" type="date" class="appearance-none border border-gray-300 rounded-md py-2 px-4 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="end">
                            End Date
                        </label>
                        <input name="end" type="date" class="appearance-none border border-gray-300 rounded-md py-2 px-4 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </div>
                </div>
                
                <div class="flex justify-center">
                    <button name="zones" class="px-8 mt-4 bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                        Show Zones
                    </button>
                </div>
            </form>
            <div class="relative overflow-x-auto">
                <h3 class="font-bold text-emerald-400 pb-3">Admin summary (most recent results shown):</h3>
                <table class="w-full text-center text-emerald-400 text-base">
                    <thead class="text-base text-gray-200 bg-emerald-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Zone Number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Designated Spots
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Rate
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Number of Reservations
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                        if (isset($_SESSION["viewData"])) {
                            $rows = $_SESSION["viewData"];
                            foreach ($rows as $row) {
                                $zoneNumber = $row["zoneNumber"];
                                $date = $row["date"];
                                $space = $row["space"];
                                $rate = $row["rate"];
                                $reservationCount = $row["reservationCount"];
                        
                                // Row
                                echo '<tr class="text-emerald-400 bg-green-200 border-b">';
                                echo "<td class='px-6 py-4 text-lg font-medium'>$zoneNumber</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>$date</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>$space</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>$$rate</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>$reservationCount</td>";
                                echo '</tr>';
                            }
                        } 

                        // No reservations in date range
                        $size = isset($_SESSION["viewData"]) 
                            && count($_SESSION["viewData"]) ? count($_SESSION["viewData"]) : 0;

                        if ($size == 0) {
                                echo '<tr class="text-emerald-400 bg-green-200 border-b">';
                                echo "<td class='px-6 py-4 text-lg font-medium'>Enter</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>a valid</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>date(s)</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>to fetch</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>data.</td>";
                                echo '</tr>';
                                
                        }
                    ?>
                    </tbody>
            </table>
        </div>
    </main>
</body>
</html>

<?php 

if (isset($_POST["zones"])) {

    // Check empty fields
    if (empty($_POST["start"]) || empty($_POST["end"])) {
        echo '<script>alert("Invalid date range.")</script>';
    } else {

        // Variables
        $startDate = $_POST["start"];
        $endDate = $_POST["end"];

        // Drop the view if it already exists
        $dropViewSQL = "DROP VIEW IF EXISTS summary";
        $connection->query($dropViewSQL);

        // Create the view
        $createViewSQL = "CREATE VIEW summary AS
            SELECT
                Lot.ZoneNumber,
                Lot.date,
                space,
                Lot.rate,
                COUNT(*) AS reservation_count
            FROM
                Lot
            JOIN
                Reservation ON Lot.ZoneNumber = Reservation.ZoneNumber AND Lot.date = Reservation.date
            WHERE
                space > 0
                AND Reservation.date >= '$startDate'
                AND Reservation.date <= '$endDate'  
            GROUP BY
                Lot.ZoneNumber, date";

        // Execute the CREATE VIEW query
        $createViewResult = $connection->query($createViewSQL);

        if ($createViewResult) {
            // View created successfully, now fetch data from the view
            $selectViewSQL = "SELECT * FROM summary";
            $viewData = $connection->query($selectViewSQL);

            if ($viewData) {

                // Add data into array
                $rows = [];
                while ($row = $viewData->fetch_assoc()) {
                    $zoneNumber = $row["ZoneNumber"];
                    $date = $row["date"];
                    $space = $row["space"];
                    $rate = $row["rate"];
                    $reservationCount = $row["reservation_count"];

                    $rows[] = [
                        'zoneNumber' => $zoneNumber,
                        'date' => $date,
                        'space' => $space,
                        'rate' => $rate,
                        'reservationCount' => $reservationCount,
                    ];
                }

                // Store rows array into session variable
                $_SESSION['viewData'] = $rows;
                header("Location: /admin.php");
                exit();

            } else {
                // Handle error fetching data from the view
                echo "Error fetching data from the view: " . $connection->error;
                
            }
        } else {
            // Handle error creating the view
            echo "Error creating the view: " . $connection->error;
        }
    }
}
?>