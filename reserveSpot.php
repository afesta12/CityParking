<!-- Start session -->
<?php 
    session_start();
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
        <!-- Spot reservation  -->
        <form action="" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <img src="/images/wondervilleLogo.png" alt="">
            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name">
            </div>

            <!-- Cellphone -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cellphone">
                    Cellphone #
                </label>
                <input name="cellphone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="cellphone" type="text" placeholder="Cellphone #">
            </div>

            <!-- Date -->
            <div class="mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="start">
                        Reservation Date
                    </label>
                    <input name="date" type="date" class="appearance-none border border-gray-300 rounded-md py-2 px-4 leading-5 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                </div>
            </div>

            <div class="flex items-center justify-center">
                <button name="search" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline" type="submit">
                    Search available spots
                </button>
            </div>
        </form>
    </main>
</body>
</html>

<?php 

    // Search for spot
    if(isset($_POST["search"])){

        // Check empty fields
        if (empty($_POST["name"]) || empty($_POST["cellphone"]) || empty($_POST["date"])) {
        
            echo '<script>alert("Name, cellphone or date left empty.")</script>';
        } else {

            // Set session variables for reservation and redirect
            $_SESSION["name"] = $_POST["name"];
            $_SESSION["cellphone"] = $_POST["cellphone"];
            $_SESSION["date"] = $_POST["date"];

            // TODO change redirect once page is finished
            header("Location: ");
        }
    }
?>