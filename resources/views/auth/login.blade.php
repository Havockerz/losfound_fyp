<x-guest-layout>

<!-- ANIMATED BACKGROUND -->
<div class="animated-bg"></div>

<!-- MAIN WRAPPER (Alpine here) -->
<div x-data="{ isRegister: false }" class="min-h-screen flex items-center justify-center px-4 relative">

    <!-- CARD -->
    <div class="w-full max-w-md bg-white/60 backdrop-blur-2xl rounded-3xl shadow-2xl p-8 overflow-hidden">

        <!-- LOGIN FORM -->
        <div x-show="!isRegister" x-transition>

            <h1 class="text-3xl font-semibold text-gray-800 text-center mb-8">
                Log in
            </h1>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <input type="email" name="email" placeholder="Email"
                    class="w-full px-4 py-3 rounded-xl bg-gray-100/80
                    focus:ring-2 focus:ring-indigo-400 outline-none text-sm" />

                <div x-data="{ show: false }" class="relative">
                    <input :type="show ? 'text' : 'password'" name="password" placeholder="Password"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100/80
                        focus:ring-2 focus:ring-indigo-400 outline-none text-sm" />

                    <button type="button" @click="show = !show"
                        class="absolute right-3 top-3 text-xs text-gray-500">
                        <span x-text="show ? 'Hide' : 'Show'"></span>
                    </button>
                </div>

                <button class="w-full py-3 rounded-xl text-white
                    bg-gradient-to-r from-orange-400 to-orange-500">
                    Log In
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-4">
                No account?
                <button @click="isRegister = true" class="text-indigo-600 font-medium">
                    Register
                </button>
            </p>

        </div>

        <!-- REGISTER FORM -->
        <div x-show="isRegister" x-transition>

            <h1 class="text-3xl font-semibold text-gray-800 text-center mb-8">
                Register
            </h1>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <input type="text" name="name" placeholder="Name"
                    class="w-full px-4 py-3 rounded-xl bg-gray-100/80" />

                <input type="email" name="email" placeholder="Email"
                    class="w-full px-4 py-3 rounded-xl bg-gray-100/80" />

                <input type="password" name="password" placeholder="Password"
                    class="w-full px-4 py-3 rounded-xl bg-gray-100/80" />

                <button class="w-full py-3 rounded-xl text-white
                    bg-gradient-to-r from-blue-500 to-blue-600">
                    Register
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-4">
                Already have account?
                <button @click="isRegister = false" class="text-indigo-600 font-medium">
                    Login
                </button>
            </p>

        </div>

    </div>

</div>

</x-guest-layout>

