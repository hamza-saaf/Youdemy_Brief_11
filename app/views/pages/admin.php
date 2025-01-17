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
            <a href="validate_teachers.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
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
            <a href="manage_users.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
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
            </a>

            <!-- Option 3: Gestion des contenus -->
            <a href="manage_content.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
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
            </a>

            <!-- Option 4: Statistiques Globales -->
            <a href="global_stats.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
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
    </main>

    <footer class="bg-white shadow-md py-4 mt-10">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-600">&copy; 2025 Youdemy. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
