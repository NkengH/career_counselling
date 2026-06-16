<x-admin-dashboard-layout>
    <x-slot name="header">
        Account Management <span class="text-gray-500 text-base font-normal ml-2">All Users</span>
    </x-slot>

    <div class="glass-panel p-6">
        <div class="flex justify-between items-center mb-6">
            <h5 class="font-bold text-lg text-gray-800">Users Directory</h5>
            <a href="{{ route('admin.users.create') }}"
                class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                <i class="fas fa-plus mr-2"></i> Add User
            </a>
        </div>

        @if(session('success'))
            <div
                class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-4 py-3 rounded-lg mb-6 flex items-center">
                <i class="fas fa-check-circle mr-3 text-lg"></i> {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="text-gray-500 border-b border-gray-100 bg-gray-50/50">
                    <tr>
                        <th class="px-4 py-3 font-medium rounded-tl-lg">ID</th>
                        <th class="px-4 py-3 font-medium">Name</th>
                        <th class="px-4 py-3 font-medium">Email</th>
                        <th class="px-4 py-3 font-medium">Role</th>
                        <th class="px-4 py-3 font-medium">Registered</th>
                        <th class="px-4 py-3 font-medium text-right rounded-tr-lg">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-4 py-4 text-gray-400">#{{ $user->id }}</td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                                        class="w-8 h-8 rounded-full shadow-sm">
                                    <span class="font-medium text-gray-800">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-gray-600">{{ $user->email }}</td>
                            <td class="px-4 py-4">
                                @if($user->role === 'admin')
                                    <span
                                        class="bg-rose-100 text-rose-700 px-2.5 py-1 rounded-md text-xs font-bold uppercase">Admin</span>
                                @elseif($user->role === 'counsellor')
                                    <span
                                        class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-md text-xs font-bold uppercase">Counsellor</span>
                                @else
                                    <span
                                        class="bg-emerald-100 text-emerald-700 px-2.5 py-1 rounded-md text-xs font-bold uppercase">Student</span>
                                @endif
                            </td>
                            <td class="px-4 py-4 text-gray-500">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-4 text-right">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                    class="text-blue-500 hover:text-blue-700 p-2 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-700 p-2 transition-colors">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-400">No users found in the system.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-dashboard-layout>