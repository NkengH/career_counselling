<x-dashboard-layout>
    <x-slot name="header">
        Available Tests
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tests as $test)
            <div
                class="glass-panel p-6 flex flex-col h-full group hover:-translate-y-1 transition-transform relative overflow-hidden">
                <!-- Decorative Top Border -->
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-primary"></div>

                <div class="mb-4 pt-2">
                    <h5 class="font-heading font-bold text-xl text-gray-800 mb-2">{{ $test->title }}</h5>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $test->description }}</p>
                </div>

                <div class="mt-auto pt-6 border-t border-gray-100">
                    <a href="{{ route('student.tests.show', $test->id) }}"
                        class="flex items-center justify-center w-full bg-primary-500 text-white py-3 rounded-xl font-medium shadow-md shadow-primary-500/20 hover:bg-primary-600 transition-colors">
                        Start Assessment <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full glass-panel flex flex-col items-center justify-center py-16">
                <div
                    class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mb-6 shadow-inner border border-emerald-100">
                    <i class="fas fa-check-circle text-4xl text-emerald-500"></i>
                </div>
                <h5 class="font-heading font-bold text-2xl text-gray-800 mb-2">You're all caught up!</h5>
                <p class="text-gray-500 text-center max-w-md">You have completed all available aptitude tests. The AI has
                    enough data to infer decisions.</p>
            </div>
        @endforelse
    </div>
</x-dashboard-layout>