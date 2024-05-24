<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <style>
        body {
            background-image: url('{{ asset('images/Fondo.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
        }
        .flex {
            display: flex;
        }
        .sidebar {
            background-color: #d4c4a7;
            width: 200px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .sidebar a {
            display: block;
            padding: 10px 15px;
            margin: 10px 0;
            background-color: #dcdcdc;
            color: black;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #c0c0c0;
        }
        .sidebar img {
            margin-bottom: 20px;
        }
        header {
            background-color: #DCB473;
            padding: 10px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-links {
            display: flex;
            align-items: center;
        }
        .header-links a, .header-links form, .header-links div {
            display: inline-block;

            margin: 0 5px;
            background-color: #dcdcdc;
            color: black;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
        }
        .header-links a:hover, .header-links form:hover, .header-links div:hover {
            background-color: #c0c0c0;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <x-banner />

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar flex flex-col items-center py-8 px-4 shadow-lg">
            <div class="flex-shrink-0 flex items-center mb-8">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/LogoBTM.png') }}" class="block h-20 w-auto" alt="Logo" />
                </a>
            </div>
            <nav class="flex-1 w-full px-2 space-y-2">
                <a href="{{ route('dashboard') }}" :class="{ 'active': request()->routeIs('dashboard') }">{{ __('Dashboard') }}</a>
                <a href="{{ route('courses') }}" :class="{ 'active': request()->routeIs('courses') }">{{ __('Cursos') }}</a>
                <a href="{{ route('assignments') }}" :active="request()->routeIs('assignments')">{{ __('Assignments') }}</a>
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('users') }}" :active="request()->routeIs('users') }}">{{ __('Users') }}</a>
                @endif
                <!-- Assignment Submissions -->
                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'teacher')
                <a href="{{ route('assignment.submissions', ['assignmentId' => 1]) }}" :active="request()->routeIs('assignment.submissions')">{{ __('Assignment Submissions') }}</a>
                <a href="{{ route('enrollments') }}" :active="request()->routeIs('enrollments') }}">{{ __('Course Enrollments') }}</a>
                @elseif(Auth::user()->role === 'student')
                <a href="{{ route('enrollments') }}" :active="request()->routeIs('enrollments') }}">{{ __('Course Enrollments') }}</a>
                <a href="{{ route('games') }}" :active="request()->routeIs('games') }}">{{ __('Games') }}</a>
                @endif
            </nav>
            <div class="mt-8 text-center text-sm text-gray-600">
                © 2024 BTM Reservados todos los derechos.
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <header>
                <div class="flex-grow">
                    <!-- Empty div to take up space and push the other content to the right -->
                </div>
                <div class="flex items-center space-x-4 header-links">
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                    <div class="flex items-center">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <div class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-white hover:text-gray-800 focus:outline-none transition ease-in-out duration-150">
                                    {{ Auth::user()->name }}
                                </div>
                            </span>
                        @endif
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>
</html>
