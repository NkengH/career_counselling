<x-admin-dashboard-layout>
    <x-slot name="header">
        Account Management <span class="text-gray-500 text-base font-normal ml-2">Add User</span>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="glass-panel p-8">
            <div class="flex items-center gap-4 mb-8">
                <a href="{{ route('admin.users.index') }}"
                    class="w-10 h-10 rounded-full bg-gray-50 text-gray-500 flex items-center justify-center hover:bg-gray-100 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h5 class="font-bold text-xl text-gray-800">Create New User</h5>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full rounded-lg border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-200 transition-shadow">
                    @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full rounded-lg border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-200 transition-shadow">
                    @error('email') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Role</label>
                    <select name="role" required
                        class="w-full rounded-lg border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-200 transition-shadow">
                        <option value="" disabled selected>Select a role...</option>
                        <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="counsellor" {{ old('role') == 'counsellor' ? 'selected' : '' }}>Counsellor</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                    @error('role') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full rounded-lg border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-200 transition-shadow">
                        @error('password') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full rounded-lg border-gray-200 focus:border-primary-500 focus:ring focus:ring-primary-200 transition-shadow">
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-6 py-2.5 rounded-lg text-gray-600 font-medium hover:bg-gray-50 transition-colors">Cancel</a>
                    <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 text-white px-6 py-2.5 rounded-lg font-medium shadow-sm transition-colors">
                        Create Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-dashboard-layout>