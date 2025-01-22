<?php

session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'administrateur')) {
    header('Location: ..\auth\login.php');
}



require '../../../vendor/autoload.php';

use App\Controllers\AdminController;
use App\Services\ServiceValidation;

$AdminInstent = new AdminController();
$validationInstent = new ServiceValidation();

$courses = $AdminInstent->getAllCourse();
$courseCount = $AdminInstent->getCourseCount();
$mostCoursesInscript = $AdminInstent->mostCoursesInscript();
$mostEnseignantInscriptions = $AdminInstent->mostEnseignantInscriptions();
$getInscriptedOfEachCategory = $AdminInstent->getInscriptedOfEachCategory();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course = $_POST['course'];
    $isValid = $validationInstent::categorieValidation($course);
    if ($isValid) {
        $AdminInstent->createCourse($course, null);
    }
}
if (isset($_GET['id'])) {
    $cours_id = $_GET['id'];
    $AdminInstent->deleteCourse($cours_id);
    $courses = $AdminInstent->getAllCourse();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>CareerLink Admin Management</title>
</head>

<body class="bg-gray-100 h-vh overflow-hidden">
    <div class="min-h-screen flex h-vh">
        <!-- Sidebar -->
        <aside
            class="bg-gray-800 text-white w-64 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out flex flex-col">
            <!-- Logo and Navigation Section -->
            <div class="flex-grow space-y-6">
                <!-- Logo -->
                <div class="flex items-center space-x-2 px-4">
                    <div class="flex items-center space-x-2">
                        <div class="bg-blue-600 text-white p-2 rounded-lg">
                            <i class="fa-solid fa-graduation-cap" style="color: #ffffff;"></i>
                        </div>
                        <a href="#"
                            class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                            Youdemy
                        </a>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="space-y-2" id="category">
                    <a href="dashboard.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                        Dashboard
                    </a>
                    <a href="category.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                        Categories
                    </a>
                    <a href="tag.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                        Tags
                    </a>
                    <a href="cours.php" class="block py-2.5 px-4 rounded transition duration-200  bg-gray-700">
                        Courses
                    </a>
                    <a href="users.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                        Users management
                    </a>
                </nav>
            </div>

            <!-- Logout Button Section -->
            <div class="border-t border-gray-700 pt-4 mt-6">
                <a href="../logout.php"
                    class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700 flex items-center space-x-2 text-red-400 hover:text-red-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Logout</span>
                </a>
            </div>
        </aside>


        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden h-screen ">
            <!-- Main content -->
            <main class="flex-1 overflow-y-scroll bg-gray-100">
                <div class="min-h-screen flex">
                    <!-- Main Content -->
                    <div class="flex-1 flex flex-col overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-gray-500 text-sm font-medium">Total Courses</h3>
                                <p class="text-3xl font-bold"><?php echo $courseCount ?></p>
                                <div class="mt-2">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">Manage Courses →</button>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-gray-500 text-sm font-medium">most Courses inscript</h3>
                                <p class="text-3xl font-bold"><?php echo $mostCoursesInscript ?></p>
                                <div class="mt-2">
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">Manage Courses →</button>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-gray-500 text-sm font-medium">Enseignant has the most inscriptions</h3>
                                <p class="text-3xl font-bold"><?php echo $mostEnseignantInscriptions ?></p>
                                <div class="mt-2">
                                    <button class="text-red-600 hover:text-red-800 text-sm">Manage Enseignant →</button>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white flex rounded-lg shadow md:grid-cols-3 gap-4 mb-8">
                            <?php if($getInscriptedOfEachCategory): ?>
                            <?php foreach($getInscriptedOfEachCategory as $data): ?>
                            <div class="bg-white rounded-lg shadow p-6">
                                <h3 class="text-gray-500 text-sm font-medium">INSERED BY CATEGORYS <?php echo $data['coursTitle'] ?></h3>
                                <p class="text-3xl font-bold"><?php echo $data['counter'] ?></p>
                                <div class="mt-2">
                                    <button class="text-red-600 hover:text-red-800 text-sm">Manage Enseignant →</button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <!-- Top header -->
                        <header class="bg-white shadow-sm flex items-center justify-around p-4">
                            <div class="flex items-center space-x-4">
                                <button onclick="showModal('addCategoryModal')"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                    Add Demande Cours
                                </button>
                            </div>
                            <button class="text-gray-500 md:hidden md:hidden "
                                onclick="document.querySelector('aside').classList.toggle('-translate-x-full')">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </header>

                        <!-- Main content -->
                        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                            <div class="container mx-auto px-4 py-8">
                                <div class="bg-white rounded-lg shadow">
                                    <div class="p-6">
                                        <h2 class="text-xl font-semibold text-gray-800 mb-6">cours Management / Order by
                                            Inscriptions</h2>

                                        <!-- Category List -->
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Couse Name</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Content Type</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Inscriptions</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">

                                                    <form action="" method="POST">
                                                        <?php if ($courses): ?>
                                                            <?php foreach ($courses as $couse): ?>
                                                                <tr>
                                                                    <?php echo '<td class=" px-6 py-4 whitespace-nowrap"><input class=" whitespace-nowrap" name="category_name" value="' . $couse['coursTitle'] . '"></td>' ?>
                                                                    <?php echo '<td class=" px-6 py-4 whitespace-nowrap"><input class=" whitespace-nowrap" name="category_name" value="' . $couse['contenu_type'] . '"></td>' ?>
                                                                    <?php echo '<td class=" px-6 py-4 whitespace-nowrap"><input class=" whitespace-nowrap" name="category_name" value="' . $couse['totalEtudiants'] . '"></td>' ?>

                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                                        <a href="cours.php?id=<?php echo $couse['id']; ?>"
                                                                            class="text-red-600 hover:text-red-900">Delete</a>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </form>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>

                <!-- create error message -->
                <?php if (isset($_SESSION['error']['message'])): ?>
                    <span
                        class="message bg-red-100 text-red-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2">
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

                <!-- create secces message -->
                <?php if (isset($_SESSION['success']['message'])): ?>
                    <span
                        class="message bg-green-100 text-green-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2">
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

                <!-- Add Category Modal -->
                <div id="addCategoryModal"
                    class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Course</h3>
                            <form class="space-y-4" action="" method="POST">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Course Name</label>
                                    <input type="text" name="course"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                        placeholder="Enter course name">
                                </div>
                                <div class="flex justify-end gap-3">
                                    <button type="button" onclick="hideModal('addCategoryModal')"
                                        class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">Cancel</button>
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add
                                        Cours</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>


        const message = document.querySelector('.message');
        if (message) {
            setTimeout(() => {
                message.remove();
            }, 3000);
        }

        function showModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function hideModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

    </script>
</body>

</html>