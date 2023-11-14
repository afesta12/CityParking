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
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <img src="/images/wondervilleLogo.png" alt="">
            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name">
            </div>

            <!-- Cellphone -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="cellphone">
                    Cellphone #
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="cellphone" type="text" placeholder="Cellphone #">
            </div>

            <!-- Date -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Reservation Date
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="date" type="text" placeholder="Reservation Date">
            </div>

            <!-- Save above info into session variables, next page to search for spots -->
            <div class="flex items-center justify-center">
                <a href="#" class="text-center text-white bg-blue-500 hover:bg-blue-700 
                                font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2  
                                focus:outline-none">
                                Search Available Spots
                </a>
            </div>
        </form>
    </main>

</body>
</html>