<x-guest-layout>
    <div class="flex w-full h-screen">

        <!-- Left Column: Form -->
        <div class="w-full lg:w-1/2 h-full flex flex-col relative overflow-y-auto bg-[#fafafa]">

            <!-- Top Logo in Flow (Removed Absolute) -->
            <div class="pt-8 px-6 sm:px-10 lg:px-12 w-full flex-none">
                <a href="/" class="inline-flex items-center gap-3">
                    <div
                        class="w-10 h-10 border border-gray-200 rounded-full flex items-center justify-center bg-white shadow-sm">
                        <i class="fas fa-graduation-cap text-[#1e3a8a] text-lg"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-gray-800">MyCareerCoach</span>
                </a>
            </div>

            <!-- Safe Centering Form Wrapper -->
            <div class="flex-1 flex w-full">
                <div class="w-full max-w-lg mx-auto px-4 sm:px-6 py-8 sm:py-12 my-auto">
                    <!-- Form Container -->
                    <div
                        class="w-full p-8 sm:p-10 lg:p-12 bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 relative z-10">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <div class="text-center mb-10">
                            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Create Account</h2>
                            <p class="text-base text-gray-500 mt-2 font-medium">Join us and start your career journey
                                today</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" id="registerForm" class="space-y-6">
                            @csrf

                            <!-- Hidden actual name for Laravel backend compatibility -->
                            <input type="hidden" name="name" id="actualName" value="">

                            <!-- I am a (Role) -->
                            <div>
                                <label class="input-label">I am a:</label>
                                <select class="input-premium focus:ring-0 text-gray-700 font-medium">
                                    <option value="student">Student</option>
                                    <option value="counsellor">Counsellor</option>
                                </select>
                            </div>

                            <!-- Names row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="input-label">First Name</label>
                                    <input class="input-premium" type="text" id="firstName"
                                        placeholder="Enter your first name" autofocus required>
                                </div>
                                <div>
                                    <label class="input-label">Last Name</label>
                                    <input class="input-premium" type="text" id="lastName"
                                        placeholder="Enter your last name" required>
                                </div>
                            </div>

                            <!-- Contact row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="input-label">Email Address</label>
                                    <input class="input-premium" type="email" name="email" :value="old('email')"
                                        placeholder="Enter your email address" required>
                                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                </div>
                                <div>
                                    <label class="input-label">Phone Number</label>
                                    <input class="input-premium" type="tel" name="phone"
                                        placeholder="Enter your phone number">
                                </div>
                            </div>

                            <!-- Passwords row -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="input-label">Password</label>
                                    <input class="input-premium" type="password" name="password"
                                        placeholder="Enter your password" required autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                </div>
                                <div>
                                    <label class="input-label">Confirm Password</label>
                                    <input class="input-premium" type="password" name="password_confirmation"
                                        placeholder="Enter your confirm password" required autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                                </div>
                            </div>

                            <!-- Date of Birth -->
                            <div>
                                <label class="input-label">Date of Birth</label>
                                <!-- HTML5 date defaults to localized formatting natively -->
                                <div class="relative">
                                    <input class="input-premium pr-8 text-gray-700" type="date" name="dob">
                                </div>
                            </div>

                            <!-- Upload NIC -->
                            <div>
                                <label class="input-label">Upload NIC (National ID Card)</label>
                                <div
                                    class="mt-2 border border-gray-200 bg-white rounded-md p-1 pl-3 text-sm flex items-center justify-between">
                                    <span class="text-gray-400 font-medium">Select a file</span>
                                    <label
                                        class="bg-gray-100 px-4 py-1.5 rounded cursor-pointer text-blue-600 font-semibold text-xs border border-gray-200 hover:bg-gray-200 transition-colors">
                                        Choose File
                                        <input type="file" class="hidden" name="nic">
                                    </label>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="pt-4">
                                <button type="submit"
                                    class="btn-red w-full py-3.5 text-lg shadow-lg shadow-rose-500/20">
                                    Create Account
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-6">
                            <p class="text-base font-medium text-gray-500">
                                Already have an account? <a href="{{ route('login') }}"
                                    class="text-[#1e3a8a] font-bold hover:underline ml-1">Sign in here</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Image Background -->
        <div class="hidden lg:block w-1/2 relative bg-gray-900 border-l border-gray-200">
            <!-- Exact overlay visual -->
            <img src="{{ asset('images/group-circle.jpg') }}" alt="Students Graduating"
                class="w-full h-full object-cover opacity-80">

            <!-- Dark gradient overlay at bottom -->
            <div class="absolute inset-x-0 bottom-0 h-64 bg-gradient-to-t from-gray-900 to-transparent"></div>

            <div class="absolute bottom-12 left-12 right-12 z-10 text-white">
                <h2 class="text-3xl font-black mb-2">Start Your Journey</h2>
                <p class="text-gray-200 text-sm font-medium max-w-sm leading-relaxed">Join thousands of students and
                    counselors building successful careers</p>
            </div>
        </div>

    </div>

    <!-- Script to combine names for backend -->
    <script>
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            var first = document.getElementById('firstName').value;
            var last = document.getElementById('lastName').value;
            document.getElementById('actualName').value = first + ' ' + last;
        });
    </script>
</x-guest-layout>