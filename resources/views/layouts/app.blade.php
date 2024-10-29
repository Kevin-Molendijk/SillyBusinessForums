<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Application</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
<!-- Header -->
<header class="bg-blue-600 p-4 text-white">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">
            <a href="{{ url('/') }}">My Forum</a>
        </h1>
        <nav>
            @guest
                <a href="{{ route('login') }}" class="mr-4">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @else
                <a href="{{ url('/user-dashboard') }}" class="mr-4">Dashboard</a>
                <span>{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline ml-2">
                    @csrf
                    <button type="submit" class="text-red-500">Logout</button>
                </form>
            @endguest

            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="ml-4">Admin Dashboard</a>
                @endif
            @endauth
        </nav>
    </div>
</header>

<!-- Content -->
<main class="container mx-auto mt-4">
    {{ $slot }}
</main>
</body>
</html>
