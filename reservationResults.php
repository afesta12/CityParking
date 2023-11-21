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
        <div class="flex justify-center">
            <img class="h-32 w-32" src="/images/wondervilleLogo.png" alt="">
        </div>
        <form action="" method="post" class="flex flex-col items-center">
            <div class="relative overflow-x-auto">
                <div class="flex items-center justify-between mb-4">
                    <label for="confNum">Select a reservation to cancel (enter the associated confirmation number):</label>
                    <select name="confNum" id="confNum" class="w-24 bg-white border border-gray-400 hover:border-gray-500 px-2 py-1 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <?php
                            $cellphone = $_SESSION["cellphone"];
                            $confirmation = $_SESSION["confirmation"];
                            $sql = "SELECT ConformationNum
                                FROM Reservation, User WHERE user.UNumber = Reservation.UNumber and (ConformationNum = '$confirmation' or  user.Phone = '$cellphone')";
                            $result = $connection->query($sql);

                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    $confNum = $row["ConformationNum"];
                                    echo "<option value='$confNum'>$confNum</option>";
                                }
                            }
                        ?>
                    </select>
                    <button name="cancel" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded-lg focus:outline-none focus:shadow-outline">
                        Cancel Reservation
                    </button>
                </div>
                </form>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 bg-green-200">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Phone Number
                </th>
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
    
    $sql = "SELECT Name, Phone, ConformationNum, Reservation.UNumber, ZoneNumber, Date, TimeIn, TimeOut, Rate, Status
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
            $name = $row["Name"];
            $phone = $row["Phone"];
            

            echo '<tr class="bg-white border-b">';
            echo "<td class='px-6 py-4'>$name</td>";
            echo "<td class='px-6 py-4'>$phone</td>";
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
    <div class="mt-4 flex justify-center">
                <a href="/index.php" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded-lg focus:outline-none focus:shadow-outline">
                    Return Home
                </a>
    </div>
</div>
</main>

</body>
</html>

<?php 
    if(isset($_POST["cancel"])){
        $confNum = $_POST["confNum"];
        $cellphone = $_SESSION["cellphone"];
        $confirmation = $_SESSION["confirmation"];

        $sql1 = "SELECT Date FROM Reservation WHERE ConformationNum = $confNum";
        $result1 = $connection->query($sql1);
        $dateRow = $result1->fetch_assoc();
        $date = $dateRow['Date'];

        if ($result1) {
            $resDate = new DateTime($date);
            $currDate = new DateTime();

            $currDate->sub(new DateInterval('P3D'));

            // If at least 3 days before current date...
            if ($currDate <= $resDate) {
                // Update status to 'Cancelled'
                $sql3 = "UPDATE Reservation SET Status = 'Cancelled' WHERE ConformationNum = $confNum";
                $result3 = $connection->query($sql3);
                echo '<script>alert("Reservation cancelled.")</script>';
                // Update page to reflect changes
                echo '<script>window.location.href = window.location.href;</script>';
            } else { // ... else notify user
                echo '<script>alert("Cancellations must be made at least 3 days in advance.")</script>';
            }
        }        
    }
?>
