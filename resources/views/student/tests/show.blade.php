<x-dashboard-layout>
    <x-slot name="header">
        Tests & Assessments
    </x-slot>

    <div class="max-w-3xl mx-auto py-4">
        <!-- Test Header Card -->
        <div class="glass-panel p-8 mb-8 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-primary-500"></div>
            <h3 class="font-heading font-bold text-3xl text-gray-800 mb-2">{{ $test->title }}</h3>
            <p class="text-gray-500 leading-relaxed">{{ $test->description }}</p>
            <!-- Decorative icon -->
            <i class="fas fa-brain text-6xl text-gray-100 absolute -right-4 -bottom-4 z-0"></i>
        </div>

        <form action="{{ route('student.tests.submit', $test->id) }}" method="POST" class="space-y-6">
            @csrf

            @foreach($test->questions as $index => $question)
                <div class="glass-panel p-6 sm:p-8 hover:border-primary-200 transition-colors relative">
                    <div class="flex items-start gap-4 mb-6">
                        <span
                            class="flex-shrink-0 w-8 h-8 rounded-lg bg-primary-100 text-primary-600 flex items-center justify-center font-bold shadow-sm ring-1 ring-primary-500/10">
                            {{ $index + 1 }}
                        </span>
                        <h5 class="font-bold text-gray-800 text-lg leading-snug pt-1">
                            {{ $question->question }}
                        </h5>
                    </div>

                    <div class="space-y-3">
                        @foreach(['a', 'b', 'c', 'd'] as $opt)
                            <label
                                class="group flex items-center p-4 border border-gray-200 rounded-xl cursor-pointer hover:bg-primary-50 hover:border-primary-300 transition-colors relative overflow-hidden shadow-sm hover:shadow-md">
                                <input type="radio" name="q_{{ $question->id }}" value="option_{{ $opt }}" required
                                    class="w-5 h-5 text-primary-500 border-gray-300 focus:ring-primary-500 disabled:opacity-50 transition-all peer">
                                <span
                                    class="ml-4 text-gray-700 peer-checked:font-semibold peer-checked:text-primary-700 select-none">
                                    {{ $question->{'option_' . $opt} }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="pt-8 pb-12 flex justify-end">
                <button type="submit"
                    class="bg-primary-500 text-white px-8 py-4 rounded-full font-bold text-lg shadow-xl shadow-primary-500/30 hover:bg-primary-600 hover:-translate-y-1 transition-all flex items-center gap-2">
                    Submit Assessment <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>
</x-dashboard-layout>