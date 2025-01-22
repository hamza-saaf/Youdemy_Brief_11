<?php
session_start();
if (!(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'etudiant')) {
    header('Location: ..\auth\login.php');
}

require_once '../../../vendor/autoload.php';

use App\Controllers\TeacherController;

$TeacherController = new TeacherController();


$courseData = $TeacherController->getMyCourses($_SESSION['user']['role_id']);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idCours = $_GET['id'];
    $TeacherController->removeInsertion($_SESSION['user']['role_id'],$idCours);
    $courseData = $TeacherController->getMyCourses($_SESSION['user']['role_id']);
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8 flex justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">My Courses</h1>
                <p class="text-gray-600">Access your enrolled courses and learning materials</p>
            </div>
            <div>
                <a href="home.php">Back</a>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Course Card 1 - Video -->
            <?php if ($courseData): ?>
                <?php foreach ($courseData as $course): ?>
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900"><?php echo $course['coursTitle']; ?></h3>
                                    <p class="text-sm text-gray-600"><?php echo $course['userName']; ?></p>
                                </div>
                                <?php if ($course['contenu_type'] === 'video'): ?>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?php echo $course['contenu_type']; ?>
                                    </span>
                                <?php else: ?>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <?php echo $course['contenu_type']; ?>
                                    </span>
                                <?php endif; ?>
                            </div>


                            <div class="mb-4">
                                <div class="text-sm text-gray-600 mb-2">Category:</div>
                                <span
                                    class="inline-block bg-gray-100 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
                                    <?php echo $course['categorieTitel']; ?>
                                </span>
                            </div>

                            <div class="mb-4">
                                <div class="text-sm text-gray-600 mb-2">Tags:</div>
                                <?php $tags = explode(',', $course['tags']); ?>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <?php foreach ($tags as $tag): ?>
                                        <span
                                            class="px-2 py-1 text-xs font-medium bg-gray-50 text-gray-600 rounded-md">#<?php echo $tag; ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <button
                                    onclick="openContent('<?= $course['contenu_url'] ?>','<?php echo $course['coursTitle']; ?>')"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    Start Course
                                </button>
                                <a href="mesCourse.php?id=<?php echo $course['id'] ?>" class="text-red-600 hover:text-red-800 z-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Content Viewer Modal -->
        <div id="contentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="rounded-lg shadow-xl w-full h-full max-w-6xl backdrop-blur-sm">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between w-full h-[10%] p-4 border-b">
                        <h3 class="text-xl font-semibold text-white" id="modalTitle">Course Content</h3>
                        <button onclick="closeContent()" class="text-gray-400 hover:text-gray-500">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- Modal Content -->
                    <div class="p-4 w-full h-[90%]">
                        <iframe id="contentFrame" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openContent(URL, Course) {
            const modal = document.getElementById('contentModal');
            const frame = document.getElementById('contentFrame');
            const title = document.getElementById('modalTitle');


            // Set the appropriate source based on content type
            frame.src = URL;
            title.textContent = Course;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeContent() {
            const modal = document.getElementById('contentModal');
            const frame = document.getElementById('contentFrame');

            frame.src = 'https://www.youtube.com/embed/eIrMbAQSU34?si=5KX2aVrVcPKLVKVC';
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

    </script>
</body>

</html>