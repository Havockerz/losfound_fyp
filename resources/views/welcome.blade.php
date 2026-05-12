<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LosFound</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        html {
    scroll-behavior: smooth;
}
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
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }
    </style>
</head>

<body class="text-white">

    <div class="animated-bg"></div>

    <!-- HERO -->
    <section class="min-h-screen flex flex-col justify-center items-center text-center px-6">

        <h1 class="text-5xl font-bold mb-6">
            Lost Something? <br> We Help You Find It
        </h1>

        <p class="text-white/80 max-w-xl mb-8">
            LosFound is a simple platform to report lost items and reconnect them with their rightful owners.
        </p>

        <div class="flex gap-4">
            <a href="{{ route('auth.merge') }}"
                class="px-8 py-3 rounded-2xl text-white font-medium no-underline bg-white/5 backdrop-blur-xl border border-white/20 transition-all duration-300 hover:bg-white/10 hover:shadow-[0_0_25px_rgba(99,102,241,0.6)] hover:scale-105">
                Get Started </a>

            <a href="#features"
                class="px-8 py-3 rounded-2xl text-white font-medium no-underline bg-white/5 backdrop-blur-xl border border-white/20 transition-all duration-300 hover:bg-white/10 hover:shadow-[0_0_25px_rgba(99,102,241,0.6)] hover:scale-105">
                Learn More </a>
    </section>

    <!-- FEATURES -->
    <section id="features" class="py-20 px-6">

        <h2 class="text-3xl font-semibold text-center mb-12">Features</h2>

        <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">

            <div class="p-6 rounded-2xl bg-white/10 backdrop-blur-lg border border-white/20">
                <h3 class="text-xl font-semibold mb-2">Report Lost Items</h3>
                <p class="text-white/70 text-sm">
                    Easily report items you've lost with details and images.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white/10 backdrop-blur-lg border border-white/20">
                <h3 class="text-xl font-semibold mb-2">Find Items</h3>
                <p class="text-white/70 text-sm">
                    Browse items found by others and claim what's yours.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white/10 backdrop-blur-lg border border-white/20">
                <h3 class="text-xl font-semibold mb-2">Secure Matching</h3>
                <p class="text-white/70 text-sm">
                    Verify ownership through smart validation questions.
                </p>
            </div>

        </div>

    </section>

    <!-- HOW IT WORKS -->
<section class="py-20 px-6 text-center">

    <h2 class="text-3xl font-semibold mb-12">How It Works</h2>

    <div class="grid md:grid-cols-3 gap-10 max-w-5xl mx-auto mb-16">

        <div>
            <h3 class="text-xl font-semibold mb-2">1. Report</h3>
            <p class="text-white/70 text-sm">
                Submit details of lost or found item.
            </p>
        </div>

        <div>
            <h3 class="text-xl font-semibold mb-2">2. Match</h3>
            <p class="text-white/70 text-sm">
                System helps match items with owners.
            </p>
        </div>

        <div>
            <h3 class="text-xl font-semibold mb-2">3. Recover</h3>
            <p class="text-white/70 text-sm">
                Safely return items to rightful owners.
            </p>
        </div>

    </div>

    <!-- ✅ BUTTON SECTION (SEPARATED) -->
    <div class="flex justify-center mt-6">
        <a href="{{ route('preview.dashboard') }}"
            class="px-10 py-4 rounded-2xl text-white font-medium no-underline
            bg-white/10 backdrop-blur-xl border border-white/20
            transition-all duration-300
            hover:bg-white/20
            hover:shadow-[0_0_30px_rgba(99,102,241,0.7)]
            hover:scale-105 active:scale-95">
            
            Preview Dashboard
        </a>
    </div>

</section>

</body>

</html>