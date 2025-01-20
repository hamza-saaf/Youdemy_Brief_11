<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Udemy-Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-md rounded-lg p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Connexion à Udemy</h2>
        <?php
        session_start();
        require_once __DIR__ . '/../../../vendor/autoload.php';

        use App\config\Database;

        if (isset($_POST['connecter'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (!empty($email) && !empty($password)) {
                $pdo = Database::connection();
                $stmt = $pdo->prepare('SELECT * FROM users WHERE email=? AND `password`=?');
                $stmt->execute([$email, $password]);
                $user = $stmt->fetch();
                if ($user) {
                    if (password_verify($password, $user['password'])) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['role'] = $user['role'];
                        $_SESSION['is_logged_in'] = true;
                    }

                    switch ($user['role']) {
                        case "admin": {
                                header("Location:../pages/admin.php");
                                exit();
                            }
                        case "teacher": {
                                header("Location:../pages/enseignant.php");
                                exit();
                            }
                        case "student": {
                                header("Location:../pages/etudiants.php");
                                exit();
                            }
                    }  
                } else {
        ?>
                    <div class="bg-yellow-400 text-white text-sm font-medium p-4 rounded" role="alert">
                    There was a problem logging in. Check your email or create an account.
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="bg-red-400 text-white text-sm font-medium p-4 rounded" role="alert">
                    Email et Mot de passe sont Obligatoires
                </div>
            <?php
            }
        } else {
            ?>
            <div class="bg-red-500 text-white text-sm font-medium p-4 rounded" role="alert">
                Email et Mot de passe sont Obligatoires
            </div>
        <?php

        }
        ?>

        <form method="POST" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Adresse e-mail</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition" value="connecter" name="connecter">Se connecter</button>
        </form>
        <p class="text-center text-sm text-gray-600 mt-4">
            Vous n'avez pas de compte ? <a href="register.php" class="text-indigo-600 hover:underline">Inscrivez-vous ici</a>.
        </p>
    </div>

</body>

</html>