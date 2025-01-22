<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-700 text-center mb-6">Create an Account</h2>
        
        <form action="register_handler.php" method="POST">
            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-gray-600 mb-2">Username</label>
                <input type="text" id="username" name="username" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-600 mb-2">Email</label>
                <input type="email" id="email" name="email" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-600 mb-2">Password</label>
                <input type="password" id="password" name="password" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Role -->
            <div class="mb-6">
                <label for="role" class="block text-gray-600 mb-2">Role</label>
                <select id="role" name="role" required 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="student">Student</option>
                    <option value="teacher">Teacher</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                    class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Register
                </button>
            </div>
        </form>
    </div>

</body>
</html>
