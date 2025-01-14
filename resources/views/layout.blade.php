<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white p-6">
        <h2 class="text-xl font-bold mb-6">Admin Panel</h2>
        <ul>
            <li>
                <a href="{{ route('media.upload') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Upload Media</a>
            </li>
            <!-- Add more links here -->
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        @yield('content') <!-- This will display the content of the specific page -->
    </div>

</div>

</body>
</html>
