<?php

session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'administrateur')) {
    header('Location: ..\auth\login.php');
}

require '../../../vendor/autoload.php';
use App\Controllers\AdminController;

$instent = new AdminController();
$allUsers = $instent->getAllUsers();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = null;
    if (isset($_GET['id_valide'])) {
        $userId = (int) $_GET['id_valide'];
        $instent->validUser($userId);
        $allUsers = $instent->getAllUsers();
    }
    if (isset($_GET['id_suspendu'])) {
        $instent->suspendUser($_GET['id_suspendu']);
        $allUsers = $instent->getAllUsers();

    }
    if (isset($_GET['id_delete'])) {
        $instent->deleteUser($_GET['id_delete']);
        $allUsers = $instent->getAllUsers();

    }
}

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
                    <a href="tag.php" class="block py-2.5 px-4 rounded transition duration-200  hover:bg-gray-700">
                        Tags
                    </a>
                    <a href="cours.php" class="block py-2.5 px-4 rounded transition duration-200  hover:bg-gray-700">
                        Courses
                    </a>
                    <a href="users.php" class="block py-2.5 px-4 rounded transition duration-200 bg-gray-700 ">
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
                        <!-- Top header -->
                        <header class="bg-white shadow-sm flex items-center justify-around p-4">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-600 text-white p-2 rounded-lg">
                                    <i class="fa-solid fa-graduation-cap" style="color: #ffffff;"></i>
                                </div>
                                <a href="#"
                                    class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                                    Youdemy
                                </a>
                            </div>
                            <button class="text-gray-500 md:hidden md:hidden "
                                onclick="document.querySelector('aside').classList.toggle('-translate-x-full')">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </header>

                        <!-- create error message -->
                        <?php if (isset($_SESSION['error']['message'])): ?>
                            <span
                                class="message bg-red-100 text-red-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2">
                                <!-- Optional: Add an error icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p><?php echo $_SESSION['error']['message']; ?></p>
                                <?php unset($_SESSION['error']['message']); ?>
                            </span>
                        <?php endif; ?>

                        <!-- Main content -->
                        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                            <div class="container mx-auto px-4 py-8">
                                <div class="bg-white rounded-lg shadow">
                                    <div class="p-6">
                                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Users Management</h2>

                                        <!-- Category List -->
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            ID</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Tag Name</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Roll</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            isActive</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Status</th>
                                                        <th
                                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                            Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    <?php if ($allUsers): ?>
                                                        <?php foreach ($allUsers as $user): ?>
                                                            <form action="" method="POST">
                                                                <tr>
                                                                    <?php echo '<td class="px-6 py-4 whitespace-nowrap">' . $user['id'] . '</td>' ?>
                                                                    <?php echo '<td class="px-6 py-4 whitespace-nowrap">' . $user['name'] . '</td>' ?>
                                                                    <?php echo '<td class="px-6 py-4 whitespace-nowrap">' . $user['role'] . '</td>' ?>
                                                                    <td class="px-6 py-4">
                                                                        <?php if ($user['isActive']): ?>
                                                                            <div class="flex items-center space-x-2">
                                                                                <div
                                                                                    class="h-2.5 w-2.5 rounded-full bg-green-500 animate-pulse">
                                                                                </div>
                                                                                <span
                                                                                    class="text-sm font-medium text-green-700">Online</span>
                                                                            </div>
                                                                        <?php else: ?>
                                                                            <div class="flex items-center space-x-2">
                                                                                <div class="h-2.5 w-2.5 rounded-full bg-gray-400">
                                                                                </div>
                                                                                <span class="text-sm font-medium text-gray-700">off
                                                                                    line</span>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="flex flex-col gap-1 max-sm:flex-col">
                                                                            <?php
                                                                            $status = $user['statut'];
                                                                            $activeClass = $status === 'valide' ?  'bg-gray-600 hover:bg-gray-700 pointer-events-none' : 'bg-green-500 hover:bg-green-700';
                                                                            $suspendedClass = $status === 'suspendu' ?  'bg-gray-600 hover:bg-gray-700 pointer-events-none' : 'bg-green-500 hover:bg-green-700';
                                                                            ?>
                                                                            <a class="<?= $activeClass; ?> text-white px-2 rounded max-sm:px-1 max-sm:text-sm"
                                                                                href="users.php?id_valide=<?php echo $user['id']; ?>">Valide</a>
                                                                            <a class="<?= $suspendedClass; ?> text-white px-2 rounded max-sm:px-1 max-sm:text-sm"
                                                                                href="users.php?id_suspendu=<?php echo $user['id']; ?>">Suspendu</a>
                                                                        </div>
                                                                    </td>
                                                                    <?php
                                                                    $deletedAt = $user['deletedAt'];
                                                                    $deletedClass = isset($deletedAt) ? 'text-gray-600 hover:text-gray-900 pointer-events-none' : 'text-red-600 hover:text-red-900';
                                                                    $deletedtext = isset($deletedAt) ? 'Deleted' : 'Delete';
                                                                    ?>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                                        <a href="users.php?id_delete=<?php echo $user['id']; ?>"
                                                                            class="<?= $deletedClass; ?> "><?php echo $deletedtext; ?></a>
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>


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
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Add New Tag</h3>
                            <form class="space-y-4" action="" method="POST">
                                <div id="parentContainer">
                                    <label class="block text-sm font-medium text-gray-700">Tag Name</label>
                                    <div class="w-full flex" id="parent">
                                        <input type="text" name="tag_name[]"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="Enter category name">
                                        <button type="button" onclick="cloneInput()">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex justify-end gap-3">
                                    <button type="button" onclick="hideModal('addCategoryModal')"
                                        class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">Cancel</button>
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add
                                        Tag</button>
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

        function cloneInput() {
            const parentDiv = document.getElementById('parent');
            const clonedDiv = parentDiv.cloneNode(true);
            clonedDiv.querySelector('input').value = '';
            document.getElementById('parentContainer').appendChild(clonedDiv);
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