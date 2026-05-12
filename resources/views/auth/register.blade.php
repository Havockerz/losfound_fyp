<x-guest-layout>

<div class="relative z-10 mt-8 flex flex-col items-center w-full">

    <h1 class="text-2xl xl:text-3xl font-extrabold text-gray-800">
        Register
    </h1>

    <style>
        .btn-2 {
            background: rgb(255,151,0);
            border: none;
            z-index: 1;
            position: relative;
            overflow: hidden;
            }

            .btn-2:after {
            position: absolute;
            content: "";
            width: 100%;
            height: 0;
            top: 0;
            left: 0;
            z-index: -1;
            border-radius: 5px;

            background-color: #eaf818;
            background-image: linear-gradient(to right, #f6d365 0%, #fda085 51%, #f6d365 100%);
            box-shadow:
                inset 2px 2px 2px 0px rgba(255,255,255,.5),
                7px 7px 20px 0px rgba(0,0,0,.1),
                4px 4px 5px 0px rgba(0,0,0,.1);

            transition: all 0.3s ease;
            }

            .btn-2:hover {
            color: #000;
            }

            .btn-2:hover:after {
            top: auto;
            bottom: 0;
            height: 100%;
            }

            .btn-2:active {
            top: 2px;
            }


            .btn-1 {
            background: rgb(0, 147, 239);
            border: none;
            z-index: 1;
            position: relative;
            overflow: hidden;
            }

            .btn-1:after {
            position: absolute;
            content: "";
            width: 100%;
            height: 0;
            top: 0;
            left: 0;
            z-index: -1;
            border-radius: 5px;

            background-color: #0e6fd0;
            background-image: linear-gradient(to right, #a1c4fd 0%, #c2e9fb 51%, #a1c4fd 100%);
            box-shadow:
                inset 2px 2px 2px 0px rgba(255,255,255,.5),
                7px 7px 20px 0px rgba(0,0,0,.1),
                4px 4px 5px 0px rgba(0,0,0,.1);

            transition: all 0.3s ease;
            }

            .btn-1:hover {
            color: #000;
            }

            .btn-1:hover:after {
            top: auto;
            bottom: 0;
            height: 100%;
            }

            .btn-1:active {
            top: 2px;
            }

            .animated-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;

            background: linear-gradient(
                120deg,
                #ff9a9e,
                #fad0c4,
                #a1c4fd,
                #c2e9fb
            );

            background-size: 300% 300%;
            animation: bgMove 15s ease infinite;
            }

            @keyframes bgMove {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
            }
    </style>

    <div class="w-full flex-1 mt-8">
        <form method="POST" action="{{ route('register') }}" 
              class="mx-auto max-w-xs w-full bg-white/70 backdrop-blur-xl rounded-2xl shadow-xl p-6">
            @csrf

            <!-- Name -->
            <div class="relative mt-4">
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="w-full px-4 pt-5 pb-2 rounded-lg bg-gray-100 border border-gray-200 focus:outline-none focus:bg-white" />
                <label class="absolute left-4 top-2 text-xs text-gray-500">Name</label>
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
            </div>

            <!-- Email -->
            <div class="relative mt-4">
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="w-full px-4 pt-5 pb-2 rounded-lg bg-gray-100 border border-gray-200 focus:outline-none focus:bg-white" />
                <label class="absolute left-4 top-2 text-xs text-gray-500">Email</label>
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
            </div>

            <!-- Phone -->
            <div class="relative mt-4">
                <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required
                    class="w-full px-4 pt-5 pb-2 rounded-lg bg-gray-100 border border-gray-200 focus:outline-none focus:bg-white" />
                <label class="absolute left-4 top-2 text-xs text-gray-500">Phone</label>
                <x-input-error :messages="$errors->get('phone')" class="mt-1 text-xs" />
            </div>

            <!-- Password -->
            <div class="relative mt-4">
                <input id="password" name="password" type="password" required
                    class="w-full px-4 pt-5 pb-2 rounded-lg bg-gray-100 border border-gray-200 focus:outline-none focus:bg-white" />
                <label class="absolute left-4 top-2 text-xs text-gray-500">Password</label>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
            </div>

            <!-- Confirm Password -->
            <div class="relative mt-4">
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="w-full px-4 pt-5 pb-2 rounded-lg bg-gray-100 border border-gray-200 focus:outline-none focus:bg-white" />
                <label class="absolute left-4 top-2 text-xs text-gray-500">Confirm Password</label>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
            </div>

            <!-- Register Button -->
            <button type="submit"
                class="btn-1 mt-6 w-full py-3 text-white rounded-lg transition relative overflow-hidden">
                Register
            </button>

            <!-- Divider -->
            <div class="my-10 border-b text-center">
                <div class="inline-block px-2 text-sm text-gray-600 translate-y-1/2 bg-transparent">
                    Already have account?
                </div>
            </div>

            <!-- Login Redirect -->
            <button type="button" onclick="window.location='{{ route('login') }}'"
                class="btn-2 w-full py-3 text-white rounded-lg transition relative overflow-hidden">
                Back to Login
            </button>

        </form>
    </div>
</div>

</x-guest-layout>