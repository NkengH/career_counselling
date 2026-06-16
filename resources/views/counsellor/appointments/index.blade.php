<x-counsellor-dashboard-layout>
    <!-- Header -->
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manage Appointments</h2>
            <p class="text-gray-500 text-sm mt-1">Review and manage your incoming student session bookings.</p>
        </div>
    </div>

    <!-- Session Alerts -->
    <x-auth-session-status class="mb-4" :status="session('success')" />

    <!-- Appointments Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
            <h3 class="font-bold text-gray-800">All Appointments</h3>
            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ $appointments->count() }}
                Total</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-gray-600">Student Name</th>
                        <th class="px-6 py-4 font-semibold text-gray-600">Requested Date</th>
                        <th class="px-6 py-4 font-semibold text-gray-600">Time</th>
                        <th class="px-6 py-4 font-semibold text-gray-600">Status</th>
                        <th class="px-6 py-4 font-semibold text-right text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($appointments as $appointment)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $appointment->student->name ?? 'Unknown Student' }}
                            </td>
                            <td class="px-6 py-4 text-gray-600"><i
                                    class="far fa-calendar-alt text-gray-400 mr-2"></i>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 text-gray-600"><i
                                    class="far fa-clock text-gray-400 mr-2"></i>{{ $appointment->appointment_time }}</td>
                            <td class="px-6 py-4">
                                @if($appointment->status === 'pending')
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 uppercase tracking-widest">Pending</span>
                                @elseif($appointment->status === 'approved')
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 uppercase tracking-widest">Approved</span>
                                @else
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 uppercase tracking-widest">Rejected</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if($appointment->status === 'pending')
                                    <div class="flex items-center justify-end gap-2 w-full">
                                        <form action="{{ route('counsellor.appointments.approve', $appointment->id) }}"
                                            method="POST" class="m-0 p-0 inline-block overflow-visible block whitespace-nowrap">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-xs font-bold transition shadow-sm w-full block">
                                                <i class="fas fa-check mr-1 text-white"></i> Approve Session
                                            </button>
                                        </form>
                                        <form action="{{ route('counsellor.appointments.reject', $appointment->id) }}"
                                            method="POST" class="m-0 p-0 inline-block overflow-visible block whitespace-nowrap">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-xs font-bold transition shadow-sm w-full block"
                                                onclick="return confirm('Are you sure you want to dismiss this appointment?');">
                                                <i class="fas fa-times mr-1 text-white"></i> Reject
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400 font-medium italic">Action Complete</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-calendar-times text-4xl text-gray-200 mb-3"></i>
                                    <p class="font-medium">No appointments have been booked yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-counsellor-dashboard-layout>