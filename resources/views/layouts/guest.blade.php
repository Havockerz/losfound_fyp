<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind + JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Animated Background -->
    <style>
        .animated-bg {
            position: fixed;
            inset: 0;
            z-index: -1;

            background: linear-gradient(135deg,
                #1e0036,
                #3a0ca3,
                #4361ee,
                #7209b7,
                #560bad);

            background-size: 300% 300%;
            animation: gradientMove 12s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center text-white">

    <!-- BACKGROUND -->
    <div class="animated-bg"></div>

    <!-- CONTENT -->
    <div class="w-full max-w-md p-6">
        {{ $slot }}
    </div>

</body>
</html>