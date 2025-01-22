<?php

session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'administrateur')) {
    header('Location: ..\auth\login.php');
}

require '../../../vendor/autoload.php';
use App\Controllers\AdminController;

$instent = new AdminController();

$usersCounter = $instent->countUsers();
$countUsersActive = $instent->countUsersActive();
$countEnseignentValid = $instent->countEnseignentValid();
$allEnseignants = $instent->getAllEnseignant();



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>CareerLink Admin Management</title>
</head>

<body class="bg-gray-100 h-vh overflow-hidden">
    <header class="hidden relative w-full max-md:flex px-5 justify-around pt-3">
        <div class="flex items-center space-x-2">
            <div class="bg-blue-600 text-white p-2 rounded-lg">
                <i class="fa-solid fa-graduation-cap" style="color: #ffffff;"></i>
            </div>
            <a href="#"
                class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                Youdemy
            </a>

        </div>
        <!-- mobile btn -->
        <button id="menu-btn" class="text-blue-600 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
        <!-- nav hidden -->
        <nav class="w-full h-0 overflow-hidden absolute top-full flex flex-col backdrop-blur-md" id="navToggel">
            <a href="dashboard.php" class="block py-2.5 w-full text-center rounded transition duration-200 hover-red-800 ">
                Dashboard
            </a>
            <a href="category.php"
                class="block py-2.5 w-full text-center rounded transition duration-200 hover:bg-red-200">
                Categories
            </a>
            <a href="tag.php" class="block py-2.5 w-full text-center rounded transition duration-200 hover:bg-gray-700">
                Tags
            </a>
            <a href="cours.php" class="block py-2.5 w-full text-center rounded transition duration-200 hover:bg-red-200">
                Courses
            </a>
            <a href="users.php"
                class="block py-2.5 w-full text-center rounded transition duration-200 hover:bg-gray-700">
                Users management
            </a>
        </nav>
    </header>
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
                    <a href="dashboard.php" class="block py-2.5 px-4 rounded transition duration-200 bg-gray-700">
                        Dashboard
                    </a>
                    <a href="category.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                        Categories
                    </a>
                    <a href="tag.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                        Tags
                    </a>
                    <a href="cours.php" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
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
                <div class="container mx-auto px-4 py-6">
                    <!-- Stats Overview -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Total Users</h3>
                            <p class="text-3xl font-bold"><?php echo $usersCounter ?></p>
                            <div class="mt-2">
                                <button class="text-blue-600 hover:text-blue-800 text-sm">Manage Users →</button>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Active Users</h3>
                            <p class="text-3xl font-bold"><?php echo $countUsersActive ?></p>
                            <div class="mt-2">
                                <button class="text-blue-600 hover:text-blue-800 text-sm">Manage Tags →</button>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Valid Enseignant</h3>
                            <p class="text-3xl font-bold"><?php echo $countEnseignentValid ?></p>
                            <div class="mt-2">
                                <button class="text-red-600 hover:text-red-800 text-sm">Review Jobs →</button>
                            </div>
                        </div>
                    </div>

                    <!-- Category Management -->
                    <div class="bg-white rounded-lg shadow mb-8">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Category Management</h2>
                            <div class="overflow-x-auto h-48">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Category
                                                Name</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                ID
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4">Technology</td>
                                            <td class="px-6 py-4">145</td>
                                            <td class="px-6 py-4">
                                                <button class="text-blue-600 hover:text-blue-800 mr-3">Edit</button>
                                                <button class="text-red-600 hover:text-red-800">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4">Marketing</td>
                                            <td class="px-6 py-4">89</td>
                                            <td class="px-6 py-4">
                                                <button class="text-blue-600 hover:text-blue-800 mr-3">Edit</button>
                                                <button class="text-red-600 hover:text-red-800">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4">Marketing</td>
                                            <td class="px-6 py-4">89</td>
                                            <td class="px-6 py-4">
                                                <button class="text-blue-600 hover:text-blue-800 mr-3">Edit</button>
                                                <button class="text-red-600 hover:text-red-800">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4">Marketing</td>
                                            <td class="px-6 py-4">89</td>
                                            <td class="px-6 py-4">
                                                <button class="text-blue-600 hover:text-blue-800 mr-3">Edit</button>
                                                <button class="text-red-600 hover:text-red-800">Delete</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4">Marketing</td>
                                            <td class="px-6 py-4">89</td>
                                            <td class="px-6 py-4">
                                                <button class="text-blue-600 hover:text-blue-800 mr-3">Edit</button>
                                                <button class="text-red-600 hover:text-red-800">Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tag Management -->
                    <div class="bg-white rounded-lg shadow mb-8">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Tag Management</h2>
                            <div class="grid grid-cols-2 gap-4 max-lg:grid-cols-2">
                                <div class="flex items-center justify-between bg-gray-100 p-3 rounded shadow-gray-300">
                                    <span>PHP</span>
                                    <div>
                                        <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                        <button class="text-red-600 hover:text-red-800">×</button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between bg-gray-100 p-3 rounded shadow-gray-300">
                                    <span>Marketing Digital</span>
                                    <div>
                                        <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                        <button class="text-red-600 hover:text-red-800">×</button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between bg-gray-100 p-3 rounded shadow-gray-300">
                                    <span>Marketing Digital</span>
                                    <div>
                                        <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                        <button class="text-red-600 hover:text-red-800">×</button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between bg-gray-100 p-3 rounded shadow-gray-300">
                                    <span>Marketing Digital</span>
                                    <div>
                                        <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                        <button class="text-red-600 hover:text-red-800">×</button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between bg-gray-100 p-3 rounded shadow-gray-300">
                                    <span>Marketing Digital</span>
                                    <div>
                                        <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                        <button class="text-red-600 hover:text-red-800">×</button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between bg-gray-100 p-3 rounded shadow-gray-300">
                                    <span>Gestion de Projet</span>
                                    <div>
                                        <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                                        <button class="text-red-600 hover:text-red-800">×</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Moderation -->
                    <div class="bg-white rounded-lg shadow mb-8">
                        <div class="p-6">
                            <h2 class="text-lg font-semibold text-gray-800 mb-2">Enseignant Management</h2>
                            <?php if ($allEnseignants): ?>
                                <?php foreach ($allEnseignants as $enseignant): ?>

                                    <div class="space-y-2">
                                        <div class="border rounded p-4">
                                            <div class="flex justify-between items-start mb-2 max-sm:mb-2">
                                                <div>
                                                    <h3 class="font-medium"><?php echo $enseignant['name'] ?></h3>
                                                    <p class="text-sm text-gray-500"><?php echo $enseignant['spesialite'] ?></p>
                                                    <div class="mt-2 flex gap-2">
                                                        <span
                                                            class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded"><?php echo $enseignant['status'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="flex gap-2 max-sm:flex-col">
                                                    <?php
                                                    $status = $enseignant['statut'];
                                                    $deletedAt = $enseignant['deletedAt'];
                                                    $activeClass = $status === 'valide' ? 'bg-gray-600 shadow-md' : 'bg-green-500';
                                                    $suspendedClass = $status === 'suspendu' ? 'bg-gray-600 shadow-md' : 'bg-yellow-500';
                                                    $deletedClass = $deletedAt === 'null' ? 'bg-gray-600 shadow-md' : 'bg-red-500';
                                                    ?>
                                                    <a
                                                        class="<?= $activeClass; ?> text-white px-3 py-1 rounded hover:bg-green-700 max-sm:px-1 max-sm:text-sm">Activer</a>
                                                    <a
                                                        class="<?= $suspendedClass; ?> text-white px-3 py-1 rounded hover:bg-yellow-700 max-sm:px-1 max-sm:text-sm">suspendu</a>
                                                    <a
                                                        class="<?= $deletedClass; ?> text-white px-3 py-1 rounded hover:bg-red-700 max-sm:px-1 max-sm:text-sm">Supprimer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            <?php endif; ?>


                        </div>
                    </div>

                </div>

            </main>
        </div>
    </div>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const navToggel = document.getElementById('navToggel');
        menuBtn.addEventListener('click', () => {
            if (navToggel.classList.contains('h-0')) {
                navToggel.classList.remove('h-0');
                navToggel.classList.add('h-auto');
            } else {
                navToggel.classList.remove('h-auto');
                navToggel.classList.add('h-0');
            }
        })




    </script>
</body>

</html>