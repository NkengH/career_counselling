<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-[#fafafa] relative overflow-hidden">

        <!-- Abstract background elements to make it less empty (optional but looks professional) -->
        <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-blue-100 rounded-bl-full blur-3xl opacity-50 z-0"></div>
        <div class="absolute bottom-0 left-0 w-1/4 h-1/4 bg-rose-100 rounded-tr-full blur-3xl opacity-50 z-0"></div>

        <div
            class="w-full max-w-md p-8 sm:p-10 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 z-10 relative">

            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <a href="/" class="flex flex-col items-center gap-1">
                    <div
                        class="w-14 h-14 border border-gray-200 rounded-full flex items-center justify-center bg-white shadow-sm">
                        <i class="fas fa-graduation-cap text-[#1e3a8a] text-2xl"></i>
                    </div>
                    <!-- Minimalistic branding text under logo -->
                    <span class="text-sm font-bold tracking-tight text-[#1e3a8a]">MyCareerCoach</span>
                </a>
            </div>

            <div class="text-center mb-10">
                <h2 class="text-4xl font-black text-gray-900 tracking-tight leading-tight">Welcome Back</h2>
                <p class="text-base text-gray-500 mt-2 font-medium">Glad to see you again. Login to your account
                    below.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label class="input-label pl-1 -mb-1 text-base text-gray-800">Email</label>
                    <input class="input-premium border-b-2 text-base" type="email" name="email" :value="old('email')"
                        placeholder="Enter your email" required autofocus autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-6">
                    <label class="input-label pl-1 -mb-1 text-base text-gray-800">Password</label>
                    <input class="input-premium border-b-2 text-base" type="password" name="password"
                        placeholder="Enter your password" required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me / Forgot Password row -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-rose-600 shadow-sm focus:ring-rose-500" name="remember">
                        <span class="ms-2 text-base font-medium text-gray-500 hover:text-gray-700 transition">Remember
                            me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-base font-semibold text-[#1e3a8a] hover:underline"
                            href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit" class="btn-red w-full py-3.5 text-lg shadow-lg shadow-rose-500/20">
                        Login
                    </button>
                </div>
            </form>

            <div class="text-center mt-8">
                <p class="text-base font-medium text-gray-800">
                    Don't have an account? <a href="{{ route('register') }}"
                        class="text-[#1e3a8a] font-bold hover:underline ml-1">Sign up now</a>
                </p>
            </div>

        </div>
    </div>
</x-guest-layout>