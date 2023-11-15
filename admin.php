<!-- Start session -->
<?php 
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
</head>
<body>
    
<!-- TODO make admin dashboard / set up DB connections -->
<!-- TODO need logout button / logout if admin leaves dashboard page -->
    <main class="flex flex-col items-center justify-center h-screen w-screen bg-green-200">

        <div class="flex flex-col bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 bg-green-200">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Zone Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Spaces
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rate
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Number of Reservations
                        </th>
                    </tr>
                </thead>
        <?php
        
            // Query
            $sql = "SELECT * FROM summary";

            // Execute query
            $view = $connection->query($sql);

            // Error handling
            if ($view) {

                echo "<tbody>";
                
                while ($row = $view->fetch_assoc()) {

                    $zoneNumber = $row["ZoneNumber"];
                    $space = $row["space"];
                    $rate = $row["rate"];
                    $reservationCount = $row["reservation_count"];

                    // Row
                    echo '<tr class="bg-white border-b">';
                    echo "<td class='px-6 py-4'>$zoneNumber</td>";
                    echo "<td class='px-6 py-4'>$space</td>";
                    echo "<td class='px-6 py-4'>$rate</td>";
                    echo "<td class='px-6 py-4'>$reservationCount</td>";
                }
            }
        
        ?>
            </table>
        </div>
        </div>
    </main>
</body>
</html>