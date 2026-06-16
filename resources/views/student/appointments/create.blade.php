<x-dashboard-layout>
    <x-slot name="header">
        Counselling Appointments
    </x-slot>

    <div class="flex items-center justify-center min-h-[70vh]">
        <div class="w-full max-w-md">
            <div
                class="glass-panel p-8 md:p-10 transform transition-all duration-300 hover:shadow-2xl hover:shadow-primary-500/10">
                <div class="text-center mb-8">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 bg-emerald-50 text-emerald-500 rounded-full mb-4 shadow-inner ring-4 ring-white">
                        <i class="fas fa-user-md text-3xl"></i>
                    </div>
                    <h3 class="font-heading font-bold text-2xl text-gray-800 mb-2">Book a Session</h3>
                    <p class="text-gray-500 text-sm">Choose an expert advisor to review your AI targets.</p>
                </div>

                <form action="{{ route('student.appointments.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">Select Target Counsellor</label>
                        <select name="counsellor_id"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-shadow shadow-sm font-medium"
                            required>
                            <option value="" disabled selected>Choose an expert...</option>
                            @foreach($counsellors as $c)
                                <option value="{{ $c->id }}">Dr/Mr/Mrs. {{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">Select Requested Date</label>
                        <input type="date" name="appointment_date"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-shadow shadow-sm font-medium"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-2">Select Expected Time</label>
                        <input type="time" name="appointment_time"
                            class="w-full bg-gray-50 border border-gray-200 text-gray-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-shadow shadow-sm font-medium"
                            required>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-gradient-primary text-white py-3.5 rounded-xl font-bold text-lg shadow-lg shadow-primary-500/30 hover:-translate-y-0.5 hover:shadow-xl transition-all flex justify-center items-center gap-2">
                            Confirm Booking Request <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>