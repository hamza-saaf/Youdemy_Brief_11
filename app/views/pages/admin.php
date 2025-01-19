<?php
// session_start();
// if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true || $_SESSION['role'] !== 'admin') {
//     header("Location: ../auth/login.php");
//     exit();
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Udemy | Dashboard Admin</title>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100 text-gray-800">
    <!-- Navbar -->
    <nav class="bg-slate-500 text-white">
        <div class="container mx-auto flex items-center justify-between p-4">
            <div class="flex items-center">
                <button class="text-gray-300 md:hidden focus:outline-none">
                    <span class="sr-only">Toggle navigation</span>
                    <div class="space-y-1">
                        <div class="w-6 h-0.5 bg-gray-300"></div>
                        <div class="w-6 h-0.5 bg-gray-300"></div>
                        <div class="w-6 h-0.5 bg-gray-300"></div>
                    </div>
                </button>
                <a href="#" class="ml-4 text-xl font-bold"><img class="w-40" src="../../../public/images/Udemy_Logo.png" alt="Udemy_Logo"></a>
            </div>
            <div class="hidden md:flex space-x-4">
                <a href="index.html" class="px-3 py-2 rounded-md text-sm font-medium bg-gray-700">
                    Dashboard
                </a>
                <a href="pages.html" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">
                    Pages
                </a>
                <a href="posts.html" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">
                    Posts
                </a>
                <a href="users.html" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">
                    Users
                </a>
            </div>
            <div class="hidden md:flex space-x-4">
                <a href="#" class="px-3 py-2 rounded-md text-sm font-medium">
                    Welcome, Hamza
                </a>
                <a href="../auth/logout.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto p-4">
            <div class="flex justify-between items-center">
                <!-- Header Title -->
                <h1 class="text-3xl font-bold flex items-center">
                    <span class="material-icons text-purple-500 mr-2">Admin</span>
                    Dashboard
                    <small class="ml-2 text-gray-500 text-lg">Manage your site</small>
                </h1>

                <!-- Create Content Dropdown -->
                <div class="relative">
                    <div class="w-full md:w-auto">
                        <div class="relative inline-block">
                            <button
                                class="bg-gray-200 text-gray-800 font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2"
                                id="dropdownButton"
                                aria-haspopup="true"
                                aria-expanded="false">
                                Create Content
                                <span class="ml-2">▼</span>
                            </button>
                            <ul
                                id="dropdownMenu"
                                class="absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden">
                                <li>
                                    <button
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                                        data-modal-target="#addPageModal">
                                        Add Page
                                    </button>
                                </li>
                                <li>
                                    <button
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                                        data-modal-target="#addPostModal">
                                        Add Post
                                    </button>
                                </li>
                                <li>
                                    <button
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left"
                                        data-modal-target="#addUserModal">
                                        Add User
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- Breadcrumb -->
    <section class="bg-gray-200">
        <div class="container mx-auto p-4">
            <ol class="list-reset flex text-gray-600">
                <li class="mr-2">Dashboard</li>
            </ol>
        </div>
    </section>
    <!-- Main Section -->
    <section id="main" class="p-6">
        <div class="flex space-x-6">
            <!-- Sidebar -->
            <div class="w-1/4 bg-slate-500 text-white rounded-lg p-4">
                <div class="space-y-4">
                    <a href="index.html" class="block px-4 py-2 bg-purple-500 rounded text-white">
                        <span class="mr-2"><i class="fas fa-cog"></i></span> Dashboard
                    </a>
                    <a href="pages.html" class="block px-4 py-2 hover:bg-gray-700 rounded">
                        <span class="mr-2"><i class="fas fa-list-alt"></i></span> Pages <span class="ml-2 bg-green-500 text-white px-2 py-1 rounded-full text-xs">12</span>
                    </a>
                    <a href="posts.html" class="block px-4 py-2 hover:bg-gray-700 rounded">
                        <span class="mr-2"><i class="fas fa-pencil-alt"></i></span> Posts <span class="ml-2 bg-green-500 text-white px-2 py-1 rounded-full text-xs">33</span>
                    </a>
                    <a href="users.html" class="block px-4 py-2 hover:bg-gray-700 rounded">
                        <span class="mr-2"><i class="fas fa-user"></i></span> Users <span class="ml-2 bg-green-500 text-white px-2 py-1 rounded-full text-xs">421</span>
                    </a>
                </div>
                <div class="mt-6 bg-gray-700 p-4 rounded-lg">
                    <h4 class="text-white">Bandwidth Used</h4>
                    <div class="w-full bg-gray-600 h-2 rounded-full">
                        <div class="bg-purple-600 h-2 rounded-full" style="width: 44%;"></div>
                    </div>
                    <h4 class="text-white mt-4">Disk Space Used</h4>
                    <div class="w-full bg-gray-600 h-2 rounded-full">
                        <div class="bg-pink-400 h-2 rounded-full" style="width: 74%;"></div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="w-3/4">
                <!-- Website Overview -->
                <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                    <h3 class="text-xl font-semibold text-indigo-600">Website Overview</h3>
                    <div class="grid grid-cols-4 gap-6 mt-6">
                        <div class="bg-gray-100 p-4 rounded-lg text-center">
                            <h2 class="text-3xl"><i class="fas fa-user"></i> 421</h2>
                            <h4 class="text-sm">Users</h4>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg text-center">
                            <h2 class="text-3xl"><i class="fas fa-list-alt"></i> 12</h2>
                            <h4 class="text-sm">Pages</h4>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg text-center">
                            <h2 class="text-3xl"><i class="fas fa-pencil-alt"></i> 33</h2>
                            <h4 class="text-sm">Posts</h4>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg text-center">
                            <h2 class="text-3xl"><i class="fas fa-chart-line"></i> 18,209</h2>
                            <h4 class="text-sm">Visitors</h4>
                        </div>
                    </div>
                </div>

                <!-- Latest Users -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Latest Users</h3>
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="border-b">
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="px-4 py-2">Nick Lotman</td>
                                <td class="px-4 py-2">lottery1212@gmail.com</td>
                                <td class="px-4 py-2">April 09, 2021</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2">Trevor White</td>
                                <td class="px-4 py-2">whiteboy@gmail.com</td>
                                <td class="px-4 py-2">Nov 13, 2020</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4 py-2">Marry S.</td>
                                <td class="px-4 py-2">incognitogirl22@gmail.com</td>
                                <td class="px-4 py-2">Feb 02, 2021</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2">Hannah Longman</td>
                                <td class="px-4 py-2">hannah.tim.log@gmail.com</td>
                                <td class="px-4 py-2">Jan 22, 2021</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Modals -->
    <!-- Add Page Modal -->
    <div
        id="addPageModal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg w-full max-w-lg p-6">
            <div class="flex justify-between items-center border-b pb-3">
                <h4 class="text-xl font-semibold">Add Page</h4>
                <button class="text-gray-500 text-2xl" data-modal-close>&times;</button>
            </div>
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Page Title</label>
                <input
                    type="text"
                    class="block w-full p-2 border border-gray-300 rounded-md"
                    placeholder="Page Title" />
                <label class="block mt-4 mb-2 text-sm font-medium text-gray-700">Page Body</label>
                <textarea
                    class="block w-full p-2 border border-gray-300 rounded-md"
                    rows="4"
                    placeholder="Write content here..."></textarea>
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button
                    class="px-4 py-2 bg-gray-500 text-white rounded-md"
                    data-modal-close>
                    Close
                </button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
            </div>
        </div>
    </div>
    <!-- Add Post Modal -->
    <div
        id="addPostModal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg w-full max-w-lg p-6">
            <div class="flex justify-between items-center border-b pb-3">
                <h4 class="text-xl font-semibold">Add Post</h4>
                <button class="text-gray-500 text-2xl" data-modal-close>&times;</button>
            </div>
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Post Title</label>
                <input
                    type="text"
                    class="block w-full p-2 border border-gray-300 rounded-md"
                    placeholder="Post Title" />
                <label class="block mt-4 mb-2 text-sm font-medium text-gray-700">Post Body</label>
                <textarea
                    class="block w-full p-2 border border-gray-300 rounded-md"
                    rows="4"
                    placeholder="Write post here..."></textarea>
                <div class="flex items-center mt-4">
                    <input type="checkbox" id="allowComments" class="mr-2" />
                    <label for="allowComments" class="text-sm text-gray-700">
                        Allow Comments Below
                    </label>
                </div>
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button
                    class="px-4 py-2 bg-gray-500 text-white rounded-md"
                    data-modal-close>
                    Close
                </button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
            </div>
        </div>
    </div>
    <!-- Add User Modal -->
    <div
        id="addUserModal"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg w-full max-w-lg p-6">
            <div class="flex justify-between items-center border-b pb-3">
                <h4 class="text-xl font-semibold">Add User</h4>
                <button class="text-gray-500 text-2xl" data-modal-close>&times;</button>
            </div>
            <div class="mt-4">
                <label class="block mb-2 text-sm font-medium text-gray-700">Name</label>
                <input
                    type="text"
                    class="block w-full p-2 border border-gray-300 rounded-md"
                    placeholder="Name" />
                <label class="block mt-4 mb-2 text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    class="block w-full p-2 border border-gray-300 rounded-md"
                    placeholder="Email" />
                <label class="block mt-4 mb-2 text-sm font-medium text-gray-700">Hobby</label>
                <textarea
                    class="block w-full p-2 border border-gray-300 rounded-md"
                    rows="4"
                    placeholder="Tell us about your hobby"></textarea>
            </div>
            <div class="flex justify-end space-x-4 mt-4">
                <button
                    class="px-4 py-2 bg-gray-500 text-white rounded-md"
                    data-modal-close>
                    Close
                </button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-md">Save</button>
            </div>
        </div>
    </div>

    <!-- CKEditor -->
    <script>
        CKEDITOR.replace("editor1");
    </script>
    <script src="../../../public/js/main.js"></script>
</body>

</html>



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Dashboard Administrateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
        <img class="w-40" src="../../../public/images/Udemy_Logo.png" alt="Udemy_Logo">

            <a href="../auth/login.php" class="text-red-500 hover:text-red-600">Déconnexion</a>
        </div>
    </header>

    <main class="container mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Bienvenue, Administrateur</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Option 1: Validation des comptes enseignants -->
<!-- <a href="validate_teachers.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-blue-500 bg-blue-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m-6 4l-6 6" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">Validation des Comptes Enseignants</h3>
                        <p class="text-gray-500">Gérez les demandes de validation des enseignants.</p>
                    </div>
                </div>
            </a>

            <!-- Option 2: Gestion des utilisateurs -->
<!-- <a href="manage_users.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-green-500 bg-green-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18m-6-6v12" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">Gestion des Utilisateurs</h3>
                        <p class="text-gray-500">Activation, suspension ou suppression des utilisateurs.</p>
                    </div>
                </div>
            </a> -->

<!-- Option 3: Gestion des contenus -->
<!-- <a href="manage_content.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-yellow-500 bg-yellow-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v16h16V4H4z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">Gestion des Contenus</h3>
                        <p class="text-gray-500">Gérez les cours, catégories et tags.</p>
                    </div>
                </div>
            </a> -->

<!-- Option 4: Statistiques Globales -->
<!-- <a href="global_stats.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-purple-500 bg-purple-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l4-4m0 0l4 4m-4-4V4" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">Statistiques Globales</h3>
                        <p class="text-gray-500">Analysez les performances globales de la plateforme.</p>
                    </div>
                </div>
            </a>
        </div>
    </main> -->

<!-- <footer class="bg-white shadow-md py-4 mt-10">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-600">&copy; 2025 Youdemy. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html> -->