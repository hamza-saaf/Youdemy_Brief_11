<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
        <img class="w-40" src="../../../public/images/Udemy_Logo.png" alt="Udemy_Logo">
            <nav>
                <a href="home.php" class="text-blue-500 hover:text-blue-700 px-4">Accueil</a>
                <a href="catalogue.php" class="text-blue-500 hover:text-blue-700 px-4">Catalogue</a>
                <a href="../auth/logout.php" class="text-red-500 hover:text-red-700 px-4">Déconnexion</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Bienvenue, Étudiant !</h2>
        <p class="text-gray-600 mb-10">Veuillez choisir une option :</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Mes Cours -->
            <a href="../cours/index.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-blue-500 bg-blue-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">Mes Cours</h3>
                        <p class="text-gray-500">Consultez les cours auxquels vous êtes inscrit.</p>
                    </div>
                </div>
            </a>

            <!-- Inscription à un Cours -->
            <a href="inscription.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-green-500 bg-green-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">S'inscrire à un Cours</h3>
                        <p class="text-gray-500">Rejoignez de nouveaux cours pour enrichir vos connaissances.</p>
                    </div>
                </div>
            </a>

            <!-- Recherche de Cours -->
            <a href="recherche.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-yellow-500 bg-yellow-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6a8 8 0 118 8h-8v-8z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">Recherche de Cours</h3>
                        <p class="text-gray-500">Trouvez les cours qui vous intéressent rapidement.</p>
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
