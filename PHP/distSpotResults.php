<?php 
    session_start();
    include("database.php");

    if(isset($_POST["distance"]) && isset($_POST["zone"])){ 
        $vName = $_POST["venue"];
        $zoneNum = $_POST["zone"];
        $vNumResult = $connection->query("SELECT VNumber FROM Venue WHERE VName = '$vName'");
        $vNumRow = $vNumResult->fetch_assoc();
        $vNum = $vNumRow['VNumber'];
        $sql6 = "SELECT Distance FROM Distance WHERE VNumber = $vNum and ZoneNumber = $zoneNum";
        $result6 = $connection->query($sql6);
        $distRow = $result6->fetch_assoc();
        $distance = $distRow["Distance"];
        $_SESSION["distance"] = $distance;
    }   
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
    <div class="flex flex-col bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="flex justify-center">
            <img class="h-32 w-32" src="/images/wondervilleLogo.png" alt="">
        </div>
        <div class="flex flex-col bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <form action="" method="post" class="flex flex-col items-center">
                <div class="flex space-x-4">
                    <div>
                        <label for="zone">Select A Zone:</label>
                        <select name="zone" id="zone" class="w-24 bg-white border border-gray-400 hover:border-gray-500 px-2 py-1 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <?php
                                $date = $_SESSION["date"];
                                $connection->query("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
                                $sql = "SELECT ZoneNumber, Space - (SELECT count(*) FROM Reservation WHERE Reservation.ZoneNumber = Lot.ZoneNumber and
                                        Reservation.Date = '$date' and Reservation.Status = 'Active') as available, Rate FROM Lot GROUP BY ZoneNumber";
                                $result = $connection->query($sql);

                                // get zones that allow reservations on chosen date
                                $sql2 = "SELECT ZoneNumber FROM Lot WHERE Date = '$date'";
                                $result2 = $connection->query($sql2);
                                $zoneArr = array();
                                while ($row = $result2->fetch_assoc()) {
                                    $zoneArr[] = $row["ZoneNumber"];
                                } 

                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        $zoneNumber = $row["ZoneNumber"];
                                        $numSpots = $row["available"];

                                        // only show zones where lot has chosen date and with available spots
                                        foreach ($zoneArr as $zoneTest) {
                                            if ($zoneTest == $zoneNumber && $numSpots > 0) {
                                                echo "<option value='$zoneNumber'>$zoneNumber</option>";
                                            }
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
                <div>
                    <label for="venue">Select A Venue:</label>
                    <select name="venue" id="venue" class="w-24 bg-white border border-gray-400 hover:border-gray-500 px-2 py-1 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <?php
                            $sql = "SELECT VName FROM Venue";
                            $result = $connection->query($sql);

                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    $venue = $row["VName"];
                                    echo "<option value='$venue'>$venue</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <button name="distance" class="mt-0 bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded-lg focus:outline-none focus:shadow-outline">
                    See Distance
                </button>
        </div>
            <div class="relative overflow-x-auto mt-6">
                <div id="distanceBox" class="p-4 mb-4 bg-gray-100 rounded">
                    <?php
                            // distance
                            if (isset($_SESSION["distance"])) {
                                echo 'Distance: ' . $_SESSION["distance"] . ' miles';
                            }
                    ?>
                </div>
                <button name="submit" class="mx-auto block bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded-lg mb-4 focus:outline-none focus:shadow-outline">
                    Submit Zone Selection
                </button>
            </form>
            <table class="w-full text-center text-emerald-400 text-base">
                <thead class="text-base text-gray-200 bg-emerald-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Zone Number
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Number of Available Spots
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rate/hr 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $date = $_SESSION["date"];
                        $connection->query("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
                        $sql = "SELECT ZoneNumber, Space - (SELECT count(*) FROM Reservation WHERE Reservation.ZoneNumber = Lot.ZoneNumber and
                                Reservation.Date = '$date' and Reservation.Status = 'Active') as available, Rate FROM Lot GROUP BY ZoneNumber";
                        $result = $connection->query($sql);

                        // get zones that allow reservations on chosen date
                        $sql2 = "SELECT ZoneNumber FROM Lot WHERE Date = '$date'";
                        $result2 = $connection->query($sql2);
                        $zoneArr = array();
                        while ($row = $result2->fetch_assoc()) {
                            $zoneArr[] = $row["ZoneNumber"];
                        }                    

                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                $zone = $row["ZoneNumber"];
                                $numSpots = $row["available"];
                                $rate = $row["Rate"];

                                // only show zones where lot has chosen date and with available spots
                                foreach ($zoneArr as $zoneTest) {
                                    if ($zoneTest == $zone && $numSpots > 0) {
                                        echo '<tr class="text-emerald-400 bg-green-200 border-b">';
                                        echo "<td class='px-6 py-4'>$zone</td>";
                                        echo "<td class='px-6 py-4'>$numSpots</td>";
                                        echo "<td class='px-6 py-4'>$rate</td>";
                                        echo '</tr>';
                                    }
                                }
                            }
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
    if(isset($_POST["submit"]) && isset($_POST["zone"])) {
        $zoneNum = $_POST["zone"];
        $cellphone = $_SESSION["cellphone"];
        $name = $_SESSION["name"];
        $date = $_SESSION["date"];

        $sql1 = "SELECT * FROM User WHERE Name = '$name'";
        $result1 = $connection->query($sql1);

        // insert user and info if does not exist
        if ($result1->num_rows == 0) {
            $insertsql = "INSERT INTO User (Name, Phone) VALUES ('$name', '$cellphone')";
            $connection->query($insertsql);
        }

        // get UNumber
        $sql2 = "SELECT UNumber FROM User WHERE Name = '$name'";
        $result2 = $connection->query($sql2);
        $row = $result2->fetch_assoc();
        $userNum = $row['UNumber'];

        // get rate
        $sql3 = "SELECT Rate FROM Lot WHERE ZoneNumber = $zoneNum";
        $result3 = $connection->query($sql3);
        $rateRow = $result3->fetch_assoc();
        $rate = $rateRow['Rate'];

        // reserve spot for user 
        $sql4 = "INSERT INTO Reservation (UNumber, ZoneNumber, Date, Rate, Status)
        VALUES ($userNum, $zoneNum, '$date', $rate, 'Active')";
        $result4 = $connection->query($sql4);

        if ($result4) {
            // get/store confirmation number
            $sql5 = "SELECT ConformationNum FROM Reservation WHERE ZoneNumber = $zoneNum and UNumber = $userNum";
            $result5 = $connection->query($sql5);
            $confRow = $result5->fetch_assoc();
            $confNum = $confRow["ConformationNum"];
            $_SESSION["confNum"] = $confNum;

            // go to page that notifies user their spot was reserved w/ confirm # and "return to home" button
            if ($result5) header("Location: /spotConfirmation.php");  
        }
    }
?>
