<?php

session_start();
if (isset($_SESSION['user']) ) {
    switch ($_SESSION['user']['role']) {
        case 'etudiant':
            header('Location: ..\app\Views\student\home.php');
            break;
        
        case 'enseignant':
            header('Location: ..\app\Views\student\home.php');
            break;
        
        case 'administrateur':
            header('Location: ..\app\Views\student\dashboard.php');
            break;
        
        default:
            # code...
            break;
    }
}


require_once './vendor/autoload.php';

use App\Controllers\TeacherController;

$TeacherController = new TeacherController();

$countData = $TeacherController->getCountCourses();

$rowsPerPage = 3;
$currentPage = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($currentPage < 1)
    $currentPage = 1;

$totalPages = ceil($countData / $rowsPerPage);
$offset = ($currentPage - 1) * $rowsPerPage;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = $_POST['inputSearch'];
    $ComplexData = $TeacherController->searchFunction($inputData);
} else {
    $ComplexData = $TeacherController->getPage($rowsPerPage, $offset, null);
}

if (isset($_GET['coursID'])) {
    $etudiantId = $_SESSION['user']['role_id'];
    $TeacherController->creatInscription($_GET['coursID'], $etudiantId);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect - Find Your Next Opportunity</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 bg-white shadow-sm z-50 ">
        <nav class="container mx-auto px-6 py-2 max-sm:py-2">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="bg-blue-600 text-white p-2 rounded-lg">
                        <i class="fa-solid fa-graduation-cap" style="color: #ffffff;"></i>
                    </div>
                    <a href="#"
                        class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                        Youdemy
                    </a>

                </div>



                <!-- Search Bar - Show on larger screens -->
                <div class="hidden md:flex flex-1 mx-8">
                    <div class="relative w-full max-w-2xl">
                        <form action="" method="POST">
                            <input id="inputSearch" name="inputSearch" type="text"
                                placeholder="Search jobs, companies, or keywords..."
                                class="w-full pl-4 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                            <button type="submit">
                                <i class="fas fa-search absolute right-4 top-3.5 text-gray-400"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Auth Buttons / notification -->
                <div class="flex items-center space-x-4">
                    <a href="./app/Views/auth/login.php"
                        class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium  max-sm:px-2  max-sm:py-1 max-sm:text-sm">Login</a>
                    <a href="./app/Views/auth/register.php"
                        class="px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200 shadow-lg shadow-blue-200 max-sm:px-2 max-sm:py-1 max-sm:text-sm">Sign
                        Up</a>
                </div>

            </div>
        </nav>
    </header>

    <!-- Main Content with Sidebar -->
    <div class=" mx-auto px-20 mt-24 mb-8 flex flex-col md:flex-row gap-6 max-sm:px-0 max-sm:mt-16">

        <!-- create secces message -->
        <?php if (isset($_SESSION['success']['message'])): ?>
            <span
                class="message bg-green-100 text-green-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2 z-50">
                <!-- Optional: Add an error icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <p><?php echo $_SESSION['success']['message']; ?></p>
                <?php unset($_SESSION['success']['message']); ?>
            </span>
        <?php endif; ?>

        <!-- create error message -->
        <?php if (isset($_SESSION['error']['message'])): ?>
            <span
                class="message bg-red-100 text-red-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2 z-50">
                <!-- Optional: Add an error icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <p><?php echo $_SESSION['error']['message']; ?></p>
                <?php unset($_SESSION['error']['message']); ?>
            </span>
        <?php endif; ?>

        <!-- Main Content - Job Listings -->
        <main class="flex-1">
            <div class="flex justify-between items-center mb-6 max-sm:mb-3 max-sm:px-3">
                <h1 class="text-2xl font-bold text-gray-800 max-sm:text-xl max-[345px]:text-[17px]">Latest Courses</h1>
                <div class="flex items-center space-x-2">
                    <a href=".\mesCourse.php"
                        class="px-4 py-2 border border-blue-200 rounded-xl focus:outline-none focus:border-blue-500 text-blue-500">
                        My Courses..
                    </a>
                </div>
            </div>

            <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <!-- Job Card 1 -->
                <?php if ($ComplexData): ?>
                    <?php foreach ($ComplexData as $course): ?>
                        <div id="grid"
                            class="bg-white rounded-xl shadow-lg hover:shadow-md transition-all duration-300 overflow-hidden group cursor-not-allowed">
                            <div class="p-5">
                                <!-- Header -->
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                            <?php echo $course['coursTitle']; ?>
                                        </h3>
                                        <span
                                            class="inline-flex items-center px-3 py-1 mt-2 rounded-full text-sm font-medium bg-blue-50 text-blue-700">
                                            <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span>
                                            <?php echo $course['categorieTitel']; ?>
                                        </span>
                                    </div>
                                </div>

                                <!-- Tags -->
                                <?php $tags = explode(',', $course['tags']); ?>
                                <div class="flex  whitespace-nowrap  gap-2 mb-4 ">
                                    <?php foreach ($tags as $tag): ?>
                                        <span
                                            class="px-2 py-1 text-xs font-medium bg-gray-50 text-gray-600 rounded-md">#<?php echo $tag; ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <iframe class="w-full h-48 sm:h-56 cursor-not-allowed" src="<?= $course['contenu_url'] ?>"
                                    frameborder="0" allowfullscreen>
                                </iframe>
                                <!-- Description -->
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                    <?php echo $course['description']; ?>
                                </p>
                                <div class="grid grid-cols-2 gap-3 text-sm">
                                    <div class="flex items-center text-gray-600 ">
                                        <i class="fas fa-map-marker-alt w-4 text-blue-500"></i>
                                        <span class="ml-2"><?php echo $course['userName']; ?></span>
                                    </div>
                                    <div class="flex items-center text-gray-600 ">
                                        <i class="fas fa-euro-sign w-4 text-green-500"></i>
                                        <span class="ml-2">45k - 55k</span>
                                    </div>
                                    <div class="flex items-center text-gray-600 ">
                                        <i class="fas fa-graduation-cap w-4 text-purple-500"></i>
                                        <span class="ml-2"><?php echo $course['ensStatus']; ?></span>
                                    </div>
                                    <div class="flex items-center text-white justify-end">
                                        <a href="./app/Views/auth/login.php"
                                            class="px-3 py-1 bg-blue-600 rounded-md">Apply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </main>
    </div>

    <nav class=" flex w-full justify-center">
        <ul class="inline-flex h-10 ">
            <li>
                <a href="index.php?page=<?= max(1, $currentPage - 1); ?>"
                    class="flex items-center justify-center px-4 h-10 ms-0  text-white bg-blue-700 border border-e-0 border-blue-900 rounded-s-lg hover:bg-blue-600 max-[400px]:px-2">Previous</a>
            </li>

            <?php for ($n = 1; $n <= $totalPages; $n) {
                $isActive = ($n == $currentPage) ? 'bg-blue-900 font-bold' : 'bg-blue-700';
                echo '<li>
                    <a href="index.php?page=' . $n . '"
                        class="flex items-center justify-center px-4 h-10 ' . $isActive . ' text-white bg-blue-700 border border-e-0 border-blue-900  hover:bg-blue-600 max-[400px]:px-2">' . $n . '</a>
                    </li>
                    ';
                $n++;
            } ?>
            <li>
                <a href="index.php?page=<?= min($totalPages, $currentPage + 1); ?>"
                    class="flex items-center justify-center px-4 h-10 border border-blue-900 rounded-e-lg text-white bg-blue-700 hover:bg-blue-600 max-[400px]:px-2">Next</a>
            </li>
        </ul>
    </nav>


    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-8 max-sm:mt-4">
        <div class="container mx-auto px-6 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="bg-blue-600 text-white p-2 rounded-lg">
                            <i class="fa-solid fa-graduation-cap" style="color: #ffffff;"></i>
                        </div>
                        <span class="text-xl font-bold">Youdemy</span>
                    </div>
                    <p class="text-gray-600 mb-4">Finding the right cours opportunity has never been easier. Connect
                        with
                        top stuffs and find your dream carear today.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-600"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-600"><i
                                class="fab fa-linkedin text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-600"><i
                                class="fab fa-facebook text-xl"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Find Cours</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Post a Cours</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">About Us</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-blue-600">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-envelope mr-2"></i>
                            contact@Youdemy.com
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-phone mr-2"></i>
                            + 212 58511779
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            123 Business Ave, Suite 100
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script>
        const message = document.querySelector('.message');
        if (message) {
            setTimeout(() => {
                message.remove();
            }, 3000);
        }


    </script>
</body>

</html>