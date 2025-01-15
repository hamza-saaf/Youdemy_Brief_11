<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des Cours - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <!-- Header Section -->
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4">
            <h1 class="text-2xl font-bold text-gray-800">Youdemy - Catalogue des Cours</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 mt-6">
        <!-- Search Bar -->
        <div class="flex justify-between items-center mb-6">
            <input 
                type="text" 
                placeholder="Rechercher un cours..." 
                class="w-full md:w-1/3 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button 
                class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600">
                Rechercher
            </button>
        </div>

        <!-- Course Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Course Card Example -->
            <div class="bg-white shadow-md rounded-md overflow-hidden">
                <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800">Titre du Cours</h2>
                    <p class="text-gray-600 mt-2">Description brève du cours pour attirer l'attention des visiteurs.</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-sm text-gray-500">Par: Enseignant</span>
                        <a href="#" class="text-blue-500 hover:underline">Voir les détails</a>
                    </div>
                </div>
            </div>

            <!-- Repeat 1 the Course Card for each course -->
            <div class="bg-white shadow-md rounded-md overflow-hidden">
                <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800">Titre du Cours</h2>
                    <p class="text-gray-600 mt-2">Description brève du cours pour attirer l'attention des visiteurs.</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-sm text-gray-500">Par: Enseignant</span>
                        <a href="#" class="text-blue-500 hover:underline">Voir les détails</a>
                    </div>
                </div>
            </div>
             <!-- Repeat 2 the Course Card for each course -->
             <div class="bg-white shadow-md rounded-md overflow-hidden">
                <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800">Titre du Cours</h2>
                    <p class="text-gray-600 mt-2">Description brève du cours pour attirer l'attention des visiteurs.</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-sm text-gray-500">Par: Enseignant</span>
                        <a href="#" class="text-blue-500 hover:underline">Voir les détails</a>
                    </div>
                </div>
            </div>
             <!-- Repeat 3 the Course Card for each course -->
             <div class="bg-white shadow-md rounded-md overflow-hidden">
                <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800">Titre du Cours</h2>
                    <p class="text-gray-600 mt-2">Description brève du cours pour attirer l'attention des visiteurs.</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-sm text-gray-500">Par: Enseignant</span>
                        <a href="#" class="text-blue-500 hover:underline">Voir les détails</a>
                    </div>
                </div>
            </div>
             <!-- Repeat the Course Card for each course -->
             <div class="bg-white shadow-md rounded-md overflow-hidden">
                <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800">Titre du Cours</h2>
                    <p class="text-gray-600 mt-2">Description brève du cours pour attirer l'attention des visiteurs.</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-sm text-gray-500">Par: Enseignant</span>
                        <a href="#" class="text-blue-500 hover:underline">Voir les détails</a>
                    </div>
                </div>
            </div>
             <!-- Repeat the Course Card for each course -->
             <div class="bg-white shadow-md rounded-md overflow-hidden">
                <img src="https://via.placeholder.com/300x200" alt="Course Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold text-gray-800">Titre du Cours</h2>
                    <p class="text-gray-600 mt-2">Description brève du cours pour attirer l'attention des visiteurs.</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-sm text-gray-500">Par: Enseignant</span>
                        <a href="#" class="text-blue-500 hover:underline">Voir les détails</a>
                    </div>
                </div>
            </div>

            <!-- Add more cards as needed -->
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-center">
            <nav aria-label="Pagination">
                <ul class="inline-flex items-center space-x-2">
                    <li><a href="#" class="px-3 py-1 bg-white border border-gray-300 rounded-md hover:bg-blue-500 hover:text-white">&laquo; Précédent</a></li>
                    <li><a href="#" class="px-3 py-1 bg-blue-500 text-white rounded-md">1</a></li>
                    <li><a href="#" class="px-3 py-1 bg-white border border-gray-300 rounded-md hover:bg-blue-500 hover:text-white">2</a></li>
                    <li><a href="#" class="px-3 py-1 bg-white border border-gray-300 rounded-md hover:bg-blue-500 hover:text-white">3</a></li>
                    <li><a href="#" class="px-3 py-1 bg-white border border-gray-300 rounded-md hover:bg-blue-500 hover:text-white">Suivant &raquo;</a></li>
                </ul>
            </nav>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-white shadow-md mt-6 py-4">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-600">&copy; 2025 Youdemy. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
