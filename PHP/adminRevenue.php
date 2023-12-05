<?php
    ob_flush();
    session_start();

    // Include database file
    include("database.php");

    // Carry over date
    $revenueDate = isset($_SESSION["revenueDate"]) ? $_SESSION["revenueDate"] : date("Y-m-d");
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
                    <li><a href="/PHP/addZone.php" class="hover:underline hover:underline-offset-4">Add Zone</a></li>
                    <li><a href="/PHP/removeZone.php" class="hover:underline hover:underline-offset-4">Remove Zone</a></li>
                    <li><a href="/PHP/updateZone.php" class="hover:underline hover:underline-offset-4">Update Zone</a></li>
                    <li><a href="/PHP/adminRevenue.php" class="hover:underline hover:underline-offset-4">Revenue Report</a></li>
                    <li><a href="/PHP/adminLogout.php" class="hover:underline hover:underline-offset-4">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main -->
    <main class="flex flex-col items-center  h-screen w-screen bg-green-200">

        <div class="flex flex-col bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="flex justify-center">
                <img class="h-32 w-32" src="/PHP/images/wondervilleLogo.png" alt="">
            </div>

            <form action="" method="post" class="flex-col items-center bg-white rounded-md px-8 pt-6 pb-8 mb-4 max-w-md mx-auto">
                <div class="text-center mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                        Date
                    </label>
                    <input name="date" type="date" value="<?php echo $revenueDate; ?>" class="appearance-none border border-gray-300 rounded-md py-2 px-4 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
                <div class="flex justify-center">
                    <button name="zones" class="shadow-md px-8 mt-4 bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                        Generate Revenue Report
                    </button>
                </div>
            </form>

            <div class="shadow-sm rounded-md relative overflow-x-auto ">
                <h3 class="font-bold text-emerald-400 pb-3">Revenue Report (most recent results shown):</h3>
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
                                Designated Spots Remaining
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Number of Reservations
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Reservation Fee
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Total Revenue
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                        // Check if session variable has data
                        if (isset($_SESSION["revenueData"])) {
                            $rows = $_SESSION["revenueData"];
                            foreach ($rows as $row) {
                                // Variables
                                $zoneNumber = $row["zoneNumber"];
                                $date = $row["date"];
                                $space = $row["space"];
                                $rate = $row["rate"];
                                $reservationCount = $row["reservationCount"];
                                $revenue = $row["revenue"];
                        
                                // Row
                                echo '<tr class="text-emerald-400 bg-green-200 border-b">';
                                echo "<td class='px-6 py-4 text-lg font-medium'>$zoneNumber</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>$date</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>$space</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>$reservationCount</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>$$rate</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>$$revenue</td>";
                                echo '</tr>';
                            }
                        } 

                        // No reservations in date range
                        $size = isset($_SESSION["revenueData"]) 
                            && count($_SESSION["revenueData"]) ? count($_SESSION["revenueData"]) : 0;

                        // Empty set -> display message
                        if ($size == 0) {
                                echo '<tr class="text-emerald-400 bg-green-200 border-b">';
                                echo "<td class='px-6 py-4 text-lg font-medium'>Enter</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>a</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>valid</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>date</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>to fetch</td>";
                                echo "<td class='px-6 py-4 text-lg font-medium'>data.</td>";
                                echo '</tr>';
                                
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>

<?php 

if (isset($_POST["zones"])) {
    
    // Check empty fields
    if (empty($_POST["date"])) {
        echo '<script>alert("Invalid date.")</script>';
    } else {
        
        // Variables
        $date = $_POST["date"];

        // Drop the view if it already exists
        $dropViewSQL = "DROP VIEW IF EXISTS revenue";
        $connection->query($dropViewSQL);

        // Create the view
        $createViewSQL = "CREATE VIEW revenue AS
            SELECT
                Lot.ZoneNumber,
                Lot.date,
                space,
                COUNT(*) AS reservation_count,
                Lot.rate,
                COUNT(*) * Lot.rate AS total_revenue
            FROM
                Lot
            JOIN
                Reservation ON Lot.ZoneNumber = Reservation.ZoneNumber AND Lot.date = '$date'
            WHERE
                space > 0
                AND Reservation.date = Lot.date
                AND Reservation.status = 'Active'
            GROUP BY
                Lot.ZoneNumber, Lot.date, space, Lot.rate";

        // Execute the CREATE VIEW query
        $createViewResult = $connection->query($createViewSQL);

        if ($createViewResult) {
            // View created successfully, now fetch data from the view
            $selectViewSQL = "SELECT * FROM revenue";
            $revenueData = $connection->query($selectViewSQL);

            if ($revenueData) {

                // Array to store results
                $rows = [];
                while ($row = $revenueData->fetch_assoc()) {
                    $zoneNumber = $row["ZoneNumber"];
                    $date = $row["date"];
                    $space = $row["space"];
                    $reservationCount = $row["reservation_count"];
                    $rate = $row["rate"];
                    $revenue = $row["total_revenue"];
                    
                    $rows[] = [
                        'zoneNumber' => $zoneNumber,
                        'date' => $date,
                        'space' => $space - $reservationCount,
                        'reservationCount' => $reservationCount,
                        'rate' => $rate,
                        'revenue' => $revenue,
                    ];
                }

                // Add array to session variable
                $_SESSION['revenueData'] = $rows;
                $_SESSION['revenueDate'] = $_POST["date"];
                echo '<script>window.location.href = window.location.href;</script>';

            } else {
                // Handle error fetching data 
                echo "Error fetching data: " . $connection->error;
                
            }
        } else {
            // Handle error creating table
            echo "Error creating table: " . $connection->error;
        }
    }
}
?>