<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LosFound') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

```blade
<body class="font-sans antialiased min-h-screen 
    bg-gradient-to-br from-purple-700 via-indigo-600 to-blue-600 text-white">

    <!-- ✅ NAVBAR (FLOATING ABOVE EVERYTHING) -->
    <div class="fixed top-0 left-0 w-full z-[9999] 
        backdrop-blur-xl bg-white/10 border-b border-white/20">
        
        <div class="max-w-7xl mx-auto px-6 py-4">
            @include('layouts.navigation')
        </div>
    </div>

    <!-- ✅ PAGE CONTENT (ADD TOP SPACE FOR NAVBAR) -->
    <div class="pt-24">

        <!-- HEADER -->
        @isset($header)
            <header class="max-w-7xl mx-auto px-6 py-6">
                <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/20 shadow-lg">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- CONTENT -->
        <main class="max-w-7xl mx-auto px-6 pb-10">
            <div class="bg-white/5 backdrop-blur-xl rounded-3xl p-8 border border-white/10 shadow-xl">
                {{ $slot }}
            </div>
        </main>

    </div>

</body>
```

</html>

