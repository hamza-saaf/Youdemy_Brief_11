<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-gray-800">Youdemy</h1>
            <a href="register.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Créer un compte</a>
        </div>
    </header>

    <main class="container mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Bienvenue sur Youdemy !</h2>
        <p class="text-gray-600 mb-10">Veuillez choisir une option pour continuer :</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Option 1: Catalogue des cours -->
            <a href="cours/index.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-blue-500 bg-blue-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-4-4m0 0l4-4m-4 4h16" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">Accéder au catalogue des cours</h3>
                        <p class="text-gray-500">Découvrez les cours disponibles sur notre plateforme.</p>
                    </div>
                </div>
            </a>

            <!-- Option 2: Création de compte -->
            <a href="auth/register.php" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition">
                <div class="flex items-center">
                    <div class="text-green-500 bg-green-100 p-4 rounded-full">
                        <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-700">Créer un compte</h3>
                        <p class="text-gray-500">Inscrivez-vous en tant qu'étudiant ou enseignant.</p>
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
