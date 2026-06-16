<x-dashboard-layout>
    <!-- dynamic Top 3 Stats row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8 mt-4">

        <!-- Card 1 -->
        <div
            class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-5 relative overflow-hidden group">
            <div class="w-12 h-12 rounded-full bg-blue-100/50 text-blue-600 flex items-center justify-center shrink-0">
                <i class="fas fa-file-alt text-xl group-hover:scale-110 transition"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 leading-none mb-1">{{ $stats['tests_taken'] }}</h2>
                <h6 class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider">Aptitude Tests Taken</h6>
            </div>
        </div>

        <!-- Card 2 -->
        <div
            class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-5 relative overflow-hidden group">
            <div
                class="w-12 h-12 rounded-full bg-orange-100/50 text-orange-500 flex items-center justify-center shrink-0">
                <i class="fas fa-shield-alt text-xl group-hover:scale-110 transition"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 leading-none mb-1">{{ $stats['recommendations'] }}</h2>
                <h6 class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider">AI Recommendations</h6>
            </div>
        </div>

        <!-- Card 3 -->
        <div
            class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-5 relative overflow-hidden group">
            <div
                class="w-12 h-12 rounded-full bg-green-100/50 text-emerald-500 flex items-center justify-center shrink-0">
                <i class="fas fa-user-friends text-xl group-hover:scale-110 transition"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-800 leading-none mb-1">{{ $stats['upcoming_sessions'] }}</h2>
                <h6 class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider">Active Sessions</h6>
            </div>
        </div>

    </div>

    <!-- Charts Grid (2 columns: 60/40 split) -->
    <!-- Real-Time Data Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Real Recent Results Table -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col">
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h4 class="font-bold text-gray-800 text-lg">Aptitude Insights</h4>
                    <p class="text-xs text-gray-500">Your most recently completed test scores</p>
                </div>
            </div>
            <div class="flex-1 overflow-auto">
                <div class="space-y-4">
                    @forelse($recentResults as $result)
                        <div
                            class="bg-gray-50 border border-gray-100 rounded-xl p-4 flex items-center justify-between hover:bg-white transition shadow-sm">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-100 text-[#1e3a8a] flex items-center justify-center font-bold">
                                    {{ substr($result->category, 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="font-semibold text-gray-800 text-sm">{{ $result->category }}</h6>
                                    <p class="text-xs text-gray-400 mt-0.5"><i
                                            class="far fa-clock mr-1"></i>{{ $result->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span
                                    class="bg-white border border-gray-200 px-3 py-1 rounded-lg font-bold text-[#1e3a8a] text-sm shadow-inner">{{ $result->score }}
                                    / {{ $result->total_questions }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 flex flex-col items-center justify-center text-gray-400">
                            <i class="far fa-clipboard text-4xl mb-3 text-gray-200"></i>
                            <p class="text-sm font-medium">You haven't taken any aptitude tests yet.</p>
                            <a href="{{ route('student.tests.index') }}"
                                class="mt-4 bg-[#1e3a8a] text-white px-5 py-2 rounded-lg text-xs font-bold shadow-sm transition hover:bg-blue-900">Take
                                Assessment <i class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Real AI Recommendations -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col">
            <div class="mb-6 z-10 relative">
                <h4 class="font-bold text-gray-800 text-lg">Top Career Match</h4>
                <p class="text-xs text-gray-500">Highest rated recommendation based on your aptitude</p>
            </div>
            <div class="flex-1">
                @if($recommendations->count() > 0)
                    @php $topMatch = $recommendations->first(); @endphp
                    <div class="h-full flex flex-col items-center justify-center py-6 text-center">
                        <div
                            class="w-24 h-24 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center shadow-inner mb-6 relative">
                            <i class="fas fa-briefcase text-4xl"></i>
                            <div
                                class="absolute -top-1 -right-1 bg-green-500 text-white text-[0.6rem] font-bold px-2 py-0.5 rounded-full shadow-sm blink">
                                MATCH</div>
                        </div>
                        <h2 class="text-2xl font-black text-gray-800 mb-2">
                            {{ $topMatch->career->title ?? 'Professional Career' }}</h2>
                        <div class="bg-gray-100 px-4 py-1.5 rounded-full mb-6 max-w-sm">
                            <span class="text-sm font-bold text-[#1e3a8a]"><i class="fas fa-robot mr-1 text-gray-400"></i>
                                {{ $topMatch->score }}% AI Confidence</span>
                        </div>
                    </div>
                @else
                    <div class="py-10 flex flex-col items-center justify-center text-gray-400 h-full">
                        <i class="fas fa-robot text-4xl mb-3 text-gray-200"></i>
                        <p class="text-sm font-medium">No recommendations populated yet.</p>
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-dashboard-layout>