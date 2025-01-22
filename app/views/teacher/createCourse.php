<?php
session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'enseignant')) {
    header('Location: ..\auth\login.php');
}

require '../../../vendor/autoload.php';

use App\Controllers\CategorieController;
use App\Controllers\TagController;
use App\Controllers\TeacherController;
use App\Classes\Course;
use App\Services\ServiceValidation;

//create instens
$catigorieInstens = new CategorieController();
$tagInstens = new TagController();
$teacherControllerInstent = new TeacherController();
$validationInstent = new ServiceValidation();

//get data
$tags = $tagInstens->getTags();
$categoris = $catigorieInstens->getCatigories();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['tags']) && is_array($_POST['tags'])) {
        $selectedTags = $_POST['tags'];
    }

    // Récupérer les données du formulaire
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $content_type = $_POST['content_type'];
    $content_url = $_POST['content_url'];
    $enseignant_id = $_SESSION['user']['id'];
    $courseInstent = new Course('', $title, $description, $content_type, $content_url, $enseignant_id, $category_id);
    $isValid = $validationInstent::courseValidation($courseInstent);
    if ($enseignant_id && $isValid) {
        $teacherControllerInstent->createCourse($courseInstent, $selectedTags);
    } else {
        
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Course</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 fixed w-full z-30 top-0">
        <div class="px-4 py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="home.php" class="text-gray-600 hover:text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <span class="ml-4 text-xl font-semibold">Create New Course</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-20 pb-8 px-4 max-w-4xl mx-auto">
        <form class="space-y-6" method="POST" action="" enctype="multipart/form-data">
            <!-- Basic Information Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Basic Information</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Course Title *
                        </label>
                        <input name="title" type="text" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter course title">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Category *
                        </label>
                        <select required name="category_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select a category</option>
                            <?php if ($categoris): ?>
                                <?php foreach ($categoris as $categori): ?>
                                    <?php echo '<option value="' . $categori['id'] . '">' . $categori['title'] . '</option>'; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- create error message -->
            <?php if (isset($_SESSION['error']['message'])): ?>
                <span
                    class="message bg-red-100 text-red-700 px-4 py-2 rounded-md flex items-center gap-2 font-medium shadow-sm border border-red-200 absolute top-4 left-1/2 transform -translate-x-1/2">
                    <!-- Optional: Add an error icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <p><?php echo $_SESSION['error']['message']; ?></p>
                    <?php unset($_SESSION['error']['message']); ?>
                </span>
            <?php endif; ?>


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

            <!-- Course Content Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Course Content</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description *
                        </label>
                        <textarea required rows="4" name="description"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Provide a detailed description of your course..."></textarea>
                    </div>

                    <!-- File Upload Section -->
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Course Content (Video or Document) *
                        </label>
                        <!-- Video Upload -->
                        <div class="space-y-2">
                            <label class="flex items-center text-sm text-gray-600">
                                <input type="radio" name="content_type" value="video" class="mr-2" checked>
                                Video
                            </label>
                            <label class="flex items-center text-sm text-gray-600">
                                <input type="radio" name="content_type" value="document" class="mr-2">
                                Document
                            </label>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                URL of cource Content *
                            </label>
                            <div
                                class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 flex justify-center items-center bg-gray-50">

                                <input type="text" name="content_url"
                                    class="absolute inset-0 w-full h-full cursor-pointer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tags Section -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Tags</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <?php if ($tags): ?>
                        <?php foreach ($tags as $tag): ?>
                            <label class="flex items-center space-x-2">
                                <?php echo '<input type="checkbox" name="tags[]" value=' . $tag['id'] . ' 
                                                class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"> '; ?>
                                <?php echo '<span class="text-sm text-gray-700"># ' . $tag['title'] . '</span>'; ?>
                            </label>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-4">
                <button type="button"
                    class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    Cancel
                </button>
                <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create Course
                </button>
            </div>
        </form>
    </div>


    <script>
        const message = document.querySelector('.message');
        if (message) {
            setTimeout(() => {
                message.remove();
            }, 3000);
        }
    </script>
</body>

</html>