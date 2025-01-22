<?php 
session_start();
if (isset($_SESSION['user']) ) {
    switch ($_SESSION['user']['role']) {
        case 'etudiant':
            header('Location: ..\student\home.php');
            break;
        
        case 'enseignant':
            header('Location: ..\teacher\home.php');
            break;
        
        case 'administrateur':
            header('Location: ..\admin\dashboard.php');
            break;
        
        default:
            # code...
            break;
    }
}

require '../../../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Classes\User;
use App\Services\ServiceValidation;

$auth = new AuthController();
$validationInstent = new ServiceValidation();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email and password from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $user = new User('',$name, $email, $password, $role);

    switch ($role) {
        case 'etudiant':
            $niveau = $_POST['niveau'];
            $isValid = $validationInstent::registerValidation($user, $niveau);
            if ($isValid) {
                $auth->signup($user,  $niveau);
            }
            break;

        case 'enseignant':
            $specialite = $_POST['specialite'];
            $status = $_POST['status'];
            $isValid = $validationInstent::registerValidation($user, $specialite, $status);
            if ($isValid) {
                $auth->signup($user,  $specialite, $status);
            }

            break;

        default:
            # code...
            break;
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .radio-checked {
            box-shadow: 0 0 0 2px #2563eb;
            border-color: #2563eb;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <nav class="container mx-auto px-6 py-4">
            <div class="flex items-center">
                <div class="flex items-center space-x-2">
                    <div class="bg-blue-600 text-white p-2 rounded-lg">
                        <i class="fa-solid fa-graduation-cap text-xl"></i>
                    </div>
                    <a href="#" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                        Youdemy
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-xl shadow-sm p-8 mt-8 max-sm:mt-0">
                <div class="text-center mb-8 ">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Créer votre compte</h1>
                    <p class="text-gray-600">Rejoignez notre communauté d'apprentissage interactive</p>
                </div>

                <!-- Sign Up Form -->
                <form class="space-y-6" action="" method="POST">
                    <?php if (isset($_SESSION['error']['message'])): ?>
                    <span class="message bg-red-100 text-red-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <p><?php echo $_SESSION['error']['message']; ?></p>
                        <?php unset($_SESSION['error']['message']); ?>
                    </span>
                    <?php endif; ?>

                    <!-- Account Type Selection -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <label id="studentLabel" class="relative border rounded-xl p-4 cursor-pointer radio-checked">
                            <input type="radio" name="role" value="etudiant" class="absolute inset-0 opacity-0" checked
                                onchange="toggleAccountType('student')">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <i class="fas fa-user-graduate text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-800">Étudiant</h3>
                                    <p class="text-sm text-gray-500">Je veux apprendre</p>
                                </div>
                            </div>
                        </label>

                        <label id="teacherLabel" class="relative border rounded-xl p-4 cursor-pointer">
                            <input type="radio" name="role" value="enseignant" class="absolute inset-0 opacity-0"
                                onchange="toggleAccountType('teacher')">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-800">Enseignant</h3>
                                    <p class="text-sm text-gray-500">Je veux enseigner</p>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Entrez votre nom complet">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Entrez votre adresse email">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                        <div class="relative">
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Créez votre mot de passe">
                            <button type="button" class="absolute right-4 top-3.5 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Student Fields -->
                    <div id="studentFields">
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Niveau d'études</label>
                            <select name="niveau" 
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                <option value="">Sélectionnez votre niveau</option>
                                <option value="debutant">Débutant</option>
                                <option value="intermediaire">Intermédiaire</option>
                                <option value="avance">Avancé</option>
                                <option value="expert">Expert</option>
                            </select>
                        </div>
                    </div>

                    <!-- Teacher Fields -->
                    <div id="teacherFields" class="hidden space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Spécialité</label>
                            <input type="text" name="specialite"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                                placeholder="Ex: Mathématiques, Informatique, Langues...">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                            <select name="status"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                <option value="">Sélectionnez votre statut</option>
                                <option value="professeur">Professeur</option>
                                <option value="formateur">Formateur indépendant</option>
                                <option value="expert">Expert du domaine</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200 shadow-lg shadow-blue-200">
                        Créer mon compte
                    </button>

                    <!-- Login Link -->
                    <p class="text-center text-gray-600 mt-6">
                        Déjà inscrit ? 
                        <a href="login.php" class="text-blue-600 hover:underline">Connectez-vous</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-8">
        <div class="container mx-auto px-6 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-600">&copy; 2025 Youdemy. Tous droits réservés.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#" class="text-gray-600 hover:text-blue-600">Politique de confidentialité</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Conditions d'utilisation</a>
                    <a href="#" class="text-gray-600 hover:text-blue-600">Contactez-nous</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const message = document.querySelector('.message');
        if (message) {
            setTimeout(() => {
                message.remove();
            }, 5000);
        }
        function toggleAccountType(type) {
            const studentFields = document.getElementById('studentFields');
            const teacherFields = document.getElementById('teacherFields');
            const studentLabel = document.getElementById('studentLabel');
            const teacherLabel = document.getElementById('teacherLabel');

            if (type === 'student') {
                studentFields.classList.remove('hidden');
                teacherFields.classList.add('hidden');
                studentLabel.classList.add('radio-checked');
                teacherLabel.classList.remove('radio-checked');
            } else {
                studentFields.classList.add('hidden');
                teacherFields.classList.remove('hidden');
                studentLabel.classList.remove('radio-checked');
                teacherLabel.classList.add('radio-checked');
            }
        }
    </script>
</body>
</html>