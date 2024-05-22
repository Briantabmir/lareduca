<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lareduca</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen flex flex-col justify-between bg-cover bg-center" style="background-image: url('{{ asset('images/Fondo.png') }}');">
    <div class="flex-grow">
        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            <div class="flex lg:justify-center lg:col-start-2">
                <img src="{{ asset('images/LogoBTM.png') }}" class="h-28 w-auto lg:h-52" alt="Logo">
            </div>
        </header>

        <div class="flex items-center justify-center flex-grow">
            @if (Route::has('login'))
                <nav class="flex space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-md px-4 py-2 text-white bg-blue-500 transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-md px-4 py-2 text-white bg-blue-500 transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-md px-4 py-2 text-white bg-green-500 transition hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </div>

    <footer class="py-6 text-center text-sm text-black bg-gray-200">
        <p>Brian Miranda</p>
    </footer>
</body>
</html>
