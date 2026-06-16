<x-counsellor-dashboard-layout>
    <!-- Header / System Overview -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800">System Overview</h2>
        <p class="text-gray-500 text-sm">Comprehensive platform management and analytics</p>
    </div>

    <!-- Dynamic Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 mt-4">

        <!-- Pending Appointments Card -->
        <div class="bg-blue-900 text-white rounded-xl p-6 shadow-sm relative overflow-hidden group">
            <h1 class="text-4xl font-bold mb-4 z-10 relative">{{ $stats['pending_appointments'] }}</h1>
            <div class="flex justify-between items-end relative z-10">
                <span class="text-xs font-medium uppercase tracking-wider text-blue-200">Pending Requests</span>
                <i class="fas fa-calendar-plus text-blue-500/30 text-3xl group-hover:scale-110 transition"></i>
            </div>
            <div
                class="absolute bottom-0 right-0 w-32 h-32 bg-blue-800 rounded-full blur-2xl opacity-50 -mr-10 -mb-10 pointer-events-none">
            </div>
        </div>

        <!-- Confirmed Sessions Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $stats['confirmed_sessions'] }}</h1>
                <div class="w-10 h-10 rounded-lg bg-green-50 text-green-500 flex items-center justify-center">
                    <i class="fas fa-calendar-check text-base"></i>
                </div>
            </div>
            <div class="flex justify-between items-end">
                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-gray-400">Confirmed Sessions</span>
                <span class="text-xs font-bold text-green-500"><i
                        class="fas fa-circle text-[0.4rem] mr-1 mb-0.5"></i>Active</span>
            </div>
        </div>

        <!-- Total Students Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $stats['total_students'] }}</h1>
                <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-500 flex items-center justify-center">
                    <i class="fas fa-user-graduate text-base"></i>
                </div>
            </div>
            <div class="flex justify-between items-end">
                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-gray-400">Total System
                    Students</span>
                <span class="text-xs font-bold text-gray-400">Database</span>
            </div>
        </div>
    </div>

    <!-- Dynamic Data Grid -->
    <div class="flex flex-col gap-6">

        <!-- Real Pending Appointments Table -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between mb-4">
                <h4 class="font-bold text-gray-800">Upcoming Requests</h4>
                <a href="{{ route('counsellor.appointments.index') }}"
                    class="text-xs font-bold text-[#1e3a8a] flex items-center hover:underline">View All <i
                        class="fas fa-arrow-right ml-1"></i></a>
            </div>
            <div class="overflow-auto border rounded-xl border-gray-100">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="text-xs text-gray-500 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-gray-600">Student</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Date</th>
                            <th class="px-6 py-4 font-semibold text-gray-600">Time</th>
                            <th class="px-6 py-4 font-semibold text-right text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pendingRequests->take(5) as $request)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-800">{{ $request->student->name ?? 'Unknown' }}
                                </td>
                                <td class="px-6 py-4 text-gray-600"><i
                                        class="far fa-calendar-alt mr-2 text-gray-400"></i>{{ \Carbon\Carbon::parse($request->appointment_date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-gray-600"><i
                                        class="far fa-clock mr-2 text-gray-400"></i>{{ $request->appointment_time }}</td>
                                <td class="px-6 py-4 text-right">
                                    <span
                                        class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold bg-yellow-100 text-yellow-700 uppercase tracking-widest">Pending</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                    <i class="far fa-check-circle text-4xl mb-3 text-gray-200"></i>
                                    <p class="font-medium text-sm">No pending appointments right now.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-counsellor-dashboard-layout>