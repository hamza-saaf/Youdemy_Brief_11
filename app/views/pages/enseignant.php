<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Espace Enseignant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
        <img class="w-40" src="../../../public/images/Udemy_Logo.png" alt="Udemy_Logo">
            <a href="home.php" class="text-blue-600 hover:underline">Retour à l'accueil</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Bienvenue, Enseignant !</h2>
        <p class="text-gray-600 mb-10">Sélectionnez une fonction pour continuer :</p>

        <!-- Options for Enseignant -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Ajouter un Cours -->
            <a href="ajouter_cours.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-green-500 bg-green-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">Ajouter un Cours</h3>
                        <p class="text-gray-500">Ajoutez un nouveau cours avec des détails complets.</p>
                    </div>
                </div>
            </a>

            <!-- Gestion des Cours -->
            <a href="gestion_cours.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-blue-500 bg-blue-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6m0 0V9m0 8h3m-3 0H6" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">Gestion des Cours</h3>
                        <p class="text-gray-500">Modifiez, supprimez ou consultez les inscriptions aux cours.</p>
                    </div>
                </div>
            </a>

            <!-- Statistiques des Cours -->
            <a href="statistiques.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-yellow-500 bg-yellow-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V4m0 7v7m-7-7h14m-7-7h7m-7 7H4" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">Statistiques des Cours</h3>
                        <p class="text-gray-500">Consultez les statistiques des cours et les inscriptions.</p>
                    </div>
                </div>
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-md py-4 mt-10">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-600">&copy; 2025 Youdemy. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
