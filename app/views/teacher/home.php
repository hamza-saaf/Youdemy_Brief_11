<?php
session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'enseignant')) {
    header('Location: ..\auth\login.php');
}

require_once '../../../vendor/autoload.php';

use App\Controllers\TeacherController;
use App\Controllers\CategorieController;

$TeacherController = new TeacherController();
$CategorieController = new CategorieController();
$ComplexData = $TeacherController->getAllCourse();
$Categorie = $CategorieController->getCatigories();
$courseDemande = $TeacherController->getCourseDemande();

if (isset($_GET['id'])) {
    $TeacherController->deleteCourse($_GET['id']);
    $ComplexData = $TeacherController->getAllCourse();
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Recruteur</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <span class="self-center text-xl font-semibold sm:text-2xl max-sm:text-sm whitespace-nowrap">Teacher
                        Dashboard</span>
                </div>
                <div class="flex items-center">
                    <a href="createCourse.php"
                        class="bg-blue-600 text-sm text-white px-4 py-2 rounded-lg hover:bg-blue-700 sm:text-base max-sm:text-xs max-sm:px-1">
                        <i class="fas fa-plus mr-2"></i>Nouvelle Course
                    </a>
                    <a href="../logout.php">
                        <div
                            class="text-red-700 flex items-center px-2 py-2 rounded-lg text-sm sm:text-base max-sm:text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Logout</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-16 px-4">
        <!-- Stats Cards -->
        <h2 class="self-center text-xl font-semibold sm:text-2xl max-sm:text-sm whitespace-nowrap">Course Demande</h2>
        <div class="flex gap-4 w-full mb-4 mt-2 p-2 overflow-x-scroll whitespace-nowrap scrollbar-hide">
            <?php if ($courseDemande): ?>
                <?php foreach ($courseDemande as $course): ?>
                    <div class="bg-white rounded-lg p-4 shadow whitespace-nowrap flex-shrink-0">
                        <?php echo '<h1 class="text-blue-600 px-4">' . $course['title'] . '</h1>'; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Success Message -->
        <?php if (isset($_SESSION['success']['message'])): ?>
            <span
                class="message bg-green-100 text-green-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-green-200 absolute top-4 left-1/2 transform -translate-x-1/2 z-50">
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

        <!-- Job Listings -->
        <div class="bg-white rounded-lg shadow p-4 mb-4">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
                <h2 class="text-xl font-bold">Courses</h2>
                <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                    <input type="text" placeholder="Rechercher..." class="border rounded-lg px-3 py-2 w-full sm:w-auto">
                    <select class="border rounded-lg px-3 py-2 w-full sm:w-auto">
                        <option>Toutes les catégories</option>
                        <?php foreach ($Categorie as $categorie): ?>
                            <option><?= $categorie['title'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <!-- Job Cards -->
            <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <!-- Job Card 1 -->


                <?php if ($ComplexData): ?>
                    <?php foreach ($ComplexData as $course): ?>
                        <div
                            class="bg-white rounded-xl shadow-lg hover:shadow-md transition-all duration-300 overflow-hidden group">
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
                                    <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="updateCourse.php?id=<?= $course['id'] ?>"
                                            class="p-1 text-gray-400 hover:text-blue-600 rounded-full hover:bg-blue-50">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="home.php?id=<?php echo $course['id']; ?>"
                                            class="p-1 text-gray-400 text-red-300 hover:text-red-600 rounded-full">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Tags -->
                                <?php $tags = explode(',', $course['tags']); ?>
                                <div class="flex whitespace-nowrap gap-2 mb-4">
                                    <?php foreach ($tags as $tag): ?>
                                        <span
                                            class="px-2 py-1 text-xs font-medium bg-gray-50 text-gray-600 rounded-md">#<?php echo $tag; ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <iframe class="w-full h-48 sm:h-56" src="<?= $course['contenu_url'] ?>" frameborder="0"
                                    allowfullscreen>
                                </iframe>
                                <!-- Description -->
                                <p class="text-sm text-gray-600 mb-4 line-clamp-2">
                                    <?php echo $course['description']; ?>
                                </p>
                                <div>
                                    Insered : <?php echo $course['CounterInsert']; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>

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