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
        <!-- Cancel reservation  -->
        <form action="cancelReservation.php" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <img src="/images/wondervilleLogo.png" alt="">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Enter A Date
                </label>
                <input name="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date" type="date" placeholder="Date">
            </div>
            <div class="flex items-center justify-between">
                <button name="cancel" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                    Cancel Reservation
                </button>
            </div>
        </form>
    </main>

</body>
</html>

<?php 
    if(isset($_POST["cancel"])){
        if (empty($_POST["date"])) {
        
            echo '<script>alert("A date must be entered.")</script>';
        }

        else {
            $date = $_POST["date"];
            $cellphone = $_SESSION["cellphone"];
            $confirmation = $_SESSION["confirmation"];

            $sql1 = "SELECT Date FROM Reservation, User WHERE user.UNumber = Reservation.UNumber and ConformationNum = '$confirmation' or  user.Phone = '$cellphone'";
            $result1 = $connection->query($sql1);

            $datesArr = array();
            if ($result1) {
                while ($row = $result1->fetch_assoc()) {
                    $datesArr[] = $row["Date"];
                }

                if (in_array($date, $datesArr)) {
                    $resDate = new DateTime($date);
                    $currDate = new DateTime();

                    $currDate->sub(new DateInterval('P3D'));

                    // If at least 3 days before current date...
                    if ($currDate <= $resDate) {
                        // ... Get UNumber
                        $sql2 = "SELECT UNumber FROM Reservation WHERE Date = '$date'";
                        $result2 = $connection->query($sql2);
                        $row = $result2->fetch_assoc();
                        $userNum = $row['UNumber'];
                        // Update status to 'Cancelled'
                        $sql3 = "UPDATE Reservation SET Status = 'Cancelled' WHERE Date = '$date' and UNumber = $userNum";
                        $result3 = $connection->query($sql3);
                        echo '<script>alert("Reservation cancelled.")</script>';
                    } else { // ... else notify user
                        echo '<script>alert("Cancellations must be made at least 3 days in advance.")</script>';
                    }
                }
                else {
                    echo '<script>alert("No such reservation exists.")</script>';
                }
            }
        }        
    }
?>
