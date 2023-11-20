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

<div class="flex flex-col bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 bg-green-200">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Confirmation Number
                </th>
                <th scope="col" class="px-6 py-3">
                    User Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Zone Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Time In
                </th>
                <th scope="col" class="px-6 py-3">
                    Time Out
                </th>
                <th scope="col" class="px-6 py-3">
                    Rate
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
            </tr>
        </thead>
<?php
    $cellphone = $_SESSION["cellphone"];
    $confirmation = $_SESSION["confirmation"];
    
    $sql = "SELECT ConformationNum, Reservation.UNumber, ZoneNumber, Date, TimeIn, TimeOut, Rate, Status
    FROM Reservation, User WHERE user.UNumber = Reservation.UNumber and (ConformationNum = '$confirmation' or  user.Phone = '$cellphone')";
    $result = $connection->query($sql);

    if ($result) {
        echo "<tbody>";  
        while ($row = $result->fetch_assoc()) {
            $confirmationNum = $row["ConformationNum"];
            $userNum = $row["UNumber"];
            $zoneNum = $row["ZoneNumber"];
            $date = $row["Date"];
            $timeIn = $row["TimeIn"];
            $timeOut = $row["TimeOut"];
            $rate = $row["Rate"];
            $status = $row["Status"];

            echo '<tr class="bg-white border-b">';
            echo "<td class='px-6 py-4'>$confirmationNum</td>";
            echo "<td class='px-6 py-4'>$userNum</td>";
            echo "<td class='px-6 py-4'>$zoneNum</td>";
            echo "<td class='px-6 py-4'>$date</td>";
            echo "<td class='px-6 py-4'>$timeIn</td>";
            echo "<td class='px-6 py-4'>$timeOut</td>";
            echo "<td class='px-6 py-4'>$rate</td>";
            echo "<td class='px-6 py-4'>$status</td>";
        }
    }
?>
    </table>
    </div>
</div>
<div class="flex flex-col bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <!-- Cancel reservation -->
    <a href="/cancelReservation.php" class="text-center text-white bg-blue-500 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
                    Cancel A Reservation
    </a>
</div>
</main>

</body>
</html>

<
