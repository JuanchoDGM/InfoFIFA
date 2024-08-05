<?php
// Connect to your XAMPP database here and fetch the player data
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "spaininfo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM players";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <!-- TAILWIND -->
    <link href="src/output.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>Players</title>
    
</head>

<body class="font-poppins">

    <nav class="bg-white border-gray-200">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="index.html" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="img/fifa-logo.png" class="h-8" alt="Flowbite Logo" />
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#e4002b] md:p-0">Home</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-white bg-[#e4002b] rounded md:bg-transparent md:text-[#e4002b] md:p-0 "
                            aria-current="page">Players</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-[#e4002b] md:p-0">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container mx-auto">
        <h1 class="text-2xl font-bold mb-4">Football Player Cards</h1>
        <div class="grid grid-cols-4 gap-4">
            <?php
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = $row["name"];
                    $position = $row["position"];
                    $age = $row["age"];
                    $image = $row["image"];

                    
                    echo '

                    <div
                        class="border max-w-sm bg-white shadow">
                        <div class="">

                            <div class="flex flex-col items-center pb-10 bg-red-600">
                                <img class="mb-3 shadow-lg w-full" src="' . $row['image'] . '" alt="pic" />
                                <h5 class="mb-1 text-xl font-bold text-yellow-300 uppercase">' . $row['name'] . '</h5>
                                <span class="text-md font-semibold text-white uppercase">' . $row['position'] . '</span>
                                <span class="text-md font-semibold text-white uppercase">' . $row['age'] . ' años</span>
                                <div class="flex mt-4 md:mt-6">
                                    <a href="#"
                                        class="inline-flex items-center px-4 py-2 text-xl font-bold text-center text-red-600 bg-yellow-300 rounded-full hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300">+</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo "No players found.";
            }

            $conn->close();
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>