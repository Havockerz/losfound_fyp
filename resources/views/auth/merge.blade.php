<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

        .animated-bg::after {
            content: "";
            position: absolute;
            inset: 0;

            background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.15), transparent 40%),
                radial-gradient(circle at 70% 70%, rgba(255, 255, 255, 0.1), transparent 50%);

            filter: blur(60px);
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

        [x-cloak] {
    display: none !important;
}
    </style>

</head>

<body class="relative min-h-screen flex items-center justify-center overflow-hidden">

    <div x-data="{ isRegister: {{ $errors->has('name') || $errors->has('phone') || $errors->has('password_confirmation') ? 'true' : 'false' }} }" class="relative w-full h-full flex items-center justify-center">

        <!-- BACKGROUND -->
        <div class="animated-bg"></div>

        <!-- CARD -->
        <div class="relative w-full max-w-5xl h-[85vh] rounded-3xl overflow-hidden shadow-[0_20px_80px_rgba(0,0,0,0.3)] bg-white/10 backdrop-blur-xl border border-white/20">

            <!-- LOGIN PANEL -->
            <div :class="isRegister ? '-translate-x-full opacity-0' : 'translate-x-0 opacity-100'" class="absolute left-0 w-1/2 h-full bg-white/20 backdrop-blur-xl border border-white/20 p-10
            transition-all duration-700 ease-in-out">

                <h2 class="text-3xl font-semibold text-white mb-6">Login</h2>

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- EMAIL -->
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-xl bg-white/30 text-white placeholder-white/70
                        focus:ring-2 focus:ring-indigo-400 outline-none"
                    />

                    <!-- PASSWORD WITH TOGGLE -->
                    <div x-data="{ show: false }" class="relative">

                        <input 
                            :type="show ? 'text' : 'password'"
                            name="password"
                            placeholder="Password"
                            required
                            class="w-full px-4 py-3 pr-12 rounded-xl bg-white/30 text-white placeholder-white/70
                            focus:ring-2 focus:ring-indigo-400 outline-none"
                        />

                        @if ($errors->has('login'))
                            <div class="text-red-400 text-sm mt-2">
                                {{ $errors->first('login') }}
                            </div>
                        @endif

                        <!-- 👁 TOGGLE -->
                        <button 
                            type="button"
                            @click="show = !show"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-white/70 hover:text-white">
                            <span x-text="show ? 'Hide' : 'Show'"></span>
                        </button>

                    </div>

                    <!-- BUTTON -->
                    <button 
                        type="submit"
                        class="w-full py-3 rounded-xl text-white font-medium
                        bg-gradient-to-r from-blue-500 to-blue-600
                        flex items-center justify-center gap-2
                        hover:scale-[1.02] transition">
                        Log In
                    </button>

                </form>
            </div>


            <!-- REGISTER PANEL -->
            <div :class="isRegister ? 'translate-x-0 opacity-100' : 'translate-x-full opacity-0'" class="absolute left-1/2 w-1/2 h-full bg-white/20 backdrop-blur-xl border border-white/20 p-10
                    transition-all duration-700 ease-in-out">

                <h2 class="text-3xl font-semibold text-white mb-6">Register</h2>

                <form method="POST" action="{{ route('register') }}"
                    x-data="{ loading: false }"
                    @submit="loading = true"
                    class="space-y-4">
                          @csrf

                    <!-- Name -->
                    <div class="relative mt-4">
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required placeholder=" "
                            class="peer w-full px-4 pt-6 pb-2 rounded-xl
                            bg-white/20 border border-white/20 text-white
                            placeholder-transparent
                            focus:outline-none focus:ring-2 focus:ring-indigo-400" />

                        <label for="name" class="absolute left-4 top-2 text-xs text-white/70
                                transition-all
                                peer-placeholder-shown:top-4
                                peer-placeholder-shown:text-sm
                                peer-focus:top-2 peer-focus:text-xs">
                                Name
                        </label>

                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-300" /></div>

                    <!-- Email -->
                    <div class="relative mt-4">
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required placeholder=" "
                            class="peer w-full px-4 pt-6 pb-2 rounded-xl
                            bg-white/20 border border-white/20 text-white
                            placeholder-transparent
                            focus:outline-none focus:ring-2 focus:ring-indigo-400
                            {{ $errors->has('email') ? 'border-red-400' : (old('email') ? 'border-green-400' : 'border-white/20') }}" />

                        <label for="email" class="absolute left-4 top-2 text-xs text-white/70
                            transition-all
                            peer-placeholder-shown:top-4
                            peer-placeholder-shown:text-sm
                            peer-focus:top-2 peer-focus:text-xs">
                            Email
                        </label>

                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-300" /></div>

                    <!-- Phone -->
                    <div class="relative mt-4">
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required placeholder=" "
                            class="peer w-full px-4 pt-6 pb-2 rounded-xl
                            bg-white/20 border border-white/20 text-white
                            placeholder-transparent
                            focus:outline-none focus:ring-2 focus:ring-indigo-400
                            {{ $errors->has('phone') ? 'border-red-400' : (old('phone') ? 'border-green-400' : 'border-white/20') }}" />
                            
                        <label for="phone" class="absolute left-4 top-2 text-xs text-white/70
                                transition-all
                                peer-placeholder-shown:top-4
                                peer-placeholder-shown:text-sm
                                peer-focus:top-2 peer-focus:text-xs">
                            Phone
                        </label>

                        <x-input-error :messages="$errors->get('phone')" class="mt-1 text-xs text-red-300" /></div>

                    <!-- Password -->
                    <div x-data="{ show: false }" class="relative mt-4">
                        <input id="password" name="password"
                            :type="show ? 'text' : 'password'"
                            required placeholder=" "
                            class="peer w-full px-4 pt-6 pb-2 pr-12 rounded-xl
                            bg-white/20 border border-white/20 text-white
                            placeholder-transparent
                            focus:outline-none focus:ring-2 focus:ring-indigo-400
                            {{ $errors->has('password') ? 'border-red-400' : (old('password') ? 'border-green-400' : 'border-white/20') }}" />

                        <label for="password"
                            class="absolute left-4 top-2 text-xs text-white/70
                            transition-all
                            peer-placeholder-shown:top-4
                            peer-placeholder-shown:text-sm
                            peer-focus:top-2 peer-focus:text-xs">
                            Password
                        </label>

                        <!--Toggle -->
                        <button
                            type="button"
                            @click="show = !show"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-white/70 hover:text-white">
                            <span x-text="show ? 'Hide' : 'Show'"></span>
                        </button>

                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-300" /></div>

                    <!-- Confirm Password -->
                    <div x-data="{ show: false }" class="relative mt-4">

                        <!-- INPUT -->
                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            :type="show ? 'text' : 'password'"
                            required
                            placeholder=" "
                            class="peer w-full px-4 pt-6 pb-2 pr-12 rounded-xl
                            bg-white/20 border
                            text-white placeholder-transparent
                            focus:outline-none focus:ring-2 focus:ring-indigo-400
                            {{ $errors->has('password_confirmation') ? 'border-red-400' : 'border-white/20' }}"
                        />

                        <!-- LABEL -->
                        <label for="password_confirmation"
                            class="absolute left-4 top-2 text-xs text-white/70
                            transition-all
                            peer-placeholder-shown:top-4
                            peer-placeholder-shown:text-sm
                            peer-focus:top-2 peer-focus:text-xs">
                            Confirm Password
                        </label>

                        <!-- TOGGLE -->
                        <button
                            type="button"
                            @click="show = !show"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-white/70 hover:text-white">
                            <span x-text="show ? 'Hide' : 'Show'"></span>
                        </button>

                        <!-- ERROR -->
                        <x-input-error
                            :messages="$errors->get('password_confirmation')"
                            class="mt-1 text-xs text-red-300" />

                    </div>
                    
                  <button 
                    type="submit"
                    :disabled="loading"
                    class="w-full py-3 rounded-xl text-white font-medium
                    bg-gradient-to-r from-blue-500 to-blue-600
                    flex items-center justify-center gap-2
                    hover:scale-[1.02] transition">

                    <!-- Spinner -->
                    <svg x-show="loading" class="animate-spin h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10"
                            stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>

                        <span x-text="loading ? 'Processing...' : 'Register'"></span>
                    </button>

                </form>

            </div>

                        <!-- OVERLAY PANEL -->
<div
    :class="isRegister ? '-translate-x-full' : 'translate-x-0'"
    class="absolute left-1/2 w-1/2 h-full
    flex items-center justify-center
    transition-all duration-700 ease-in-out
    rounded-r-3xl
    overflow-hidden">

    <!-- Gradient background -->
    <div class="absolute inset-0 bg-gradient-to-br 
        from-purple-700 via-purple-600 to-indigo-600"></div>

    <!-- Glow effect -->
<div class="absolute inset-0"
     style="background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.2), transparent 40%)">
</div>
    <!-- CONTENT -->
    <div class="relative z-10 text-center px-10 max-w-md">

        <!-- LOGIN SIDE -->
        <div x-show="!isRegister" x-transition>
            <h2 class="text-4xl font-bold mb-4 text-white">
                Hello, Welcome!
            </h2>

            <p class="mb-8 text-white/80 text-sm leading-relaxed">
                Enter your personal details and start your journey with us
            </p>

            <button @click="isRegister = true"
                class="px-8 py-2 rounded-full border border-white
                text-white font-medium tracking-wide
                hover:bg-gradient-to-r hover:from-purple-600 hover:to-indigo-600 transition">
                REGISTER
            </button>

        </div>

        <!-- REGISTER SIDE -->
        <div x-show="isRegister" x-transition>
            <h2 class="text-4xl font-bold mb-4 text-white">
                Welcome Back!
            </h2>

            <p class="mb-8 text-white/80 text-sm">
                Already have an account?
            </p>

            <button @click="isRegister = false"
                class="px-8 py-2 rounded-full border border-white
                text-white font-medium tracking-wide
                hover:bg-gradient-to-r hover:from-purple-600 hover:to-indigo-600 transition">
                LOGIN
            </button>

        </div>

    </div>
</div>

        </div>

</body>

</html>