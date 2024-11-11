<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

@if(session('success'))
    <div class="bg-green-100 border-t-4 border-green-500 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border-t-4 border-red-500 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

@if(session('info'))
    <div class="bg-blue-100 border-t-4 border-blue-500 text-blue-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Info!</strong>
        <span class="block sm:inline">{{ session('info') }}</span>
    </div>
@endif
<div class="container">
    @yield('content')
</div>
</body>
</html>
