<x-dashboard-layout>
    <!-- Chat Header -->
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-robot text-orange-500"></i> AI Career Architect
            </h2>
            <p class="text-gray-500 text-sm mt-1">Chat intelligently to determine exactly what you should study.</p>
        </div>
        @if($session->status === 'completed')
            <span
                class="px-4 py-1.5 bg-green-100 text-green-700 font-bold rounded-full text-xs uppercase tracking-widest"><i
                    class="fas fa-check-circle mr-1"></i> Assessment Complete</span>
        @else
            <span
                class="px-4 py-1.5 bg-yellow-100 text-yellow-700 font-bold rounded-full text-xs uppercase tracking-widest blink"><i
                    class="fas fa-circle text-[0.5rem] mr-1 mb-0.5"></i> Interview Active</span>
        @endif
    </div>

    <!-- Main Container -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-[70vh]">

        <!-- Conversation Thread Area -->
        <div id="chat-thread" class="flex-1 p-6 overflow-y-auto bg-gray-50/30 flex flex-col gap-6">

            <!-- History Binding Map -->
            @foreach($session->questions as $q)
                <!-- AI Question Block -->
                <div class="flex gap-4 items-end slide-up max-w-3xl">
                    <div
                        class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center shadow-sm shrink-0">
                        <i class="fas fa-robot"></i>
                    </div>
                    <div
                        class="bg-white border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm text-gray-700 text-sm leading-relaxed">
                        {{ $q->question_text }}
                    </div>
                </div>

                @if($q->answer)
                    <!-- Connected Student Answer -->
                    <div class="flex gap-4 items-end self-end max-w-3xl flex-row-reverse slide-up">
                        <div
                            class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shadow-sm shrink-0 font-bold">
                            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div
                            class="bg-blue-600 border border-blue-700 p-4 rounded-2xl rounded-br-sm shadow-sm text-white text-sm leading-relaxed">
                            {{ $q->answer->answer_text }}
                        </div>
                    </div>
                @endif
            @endforeach

            <!-- AI Typing Indicator -->
            <div id="typing-indicator" class="flex gap-4 items-end max-w-3xl hidden">
                <div
                    class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center shadow-sm shrink-0">
                    <i class="fas fa-robot blink"></i>
                </div>
                <div
                    class="bg-white border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm text-gray-400 text-sm flex items-center gap-1.5">
                    <span class="w-2 h-2 bg-gray-300 rounded-full bounce-delay-1"></span>
                    <span class="w-2 h-2 bg-gray-300 rounded-full bounce-delay-2"></span>
                    <span class="w-2 h-2 bg-gray-300 rounded-full bounce-delay-3"></span>
                </div>
            </div>

        </div>

        @if($session->status === 'in_progress')
            <!-- Interaction Console -->
            <div class="p-4 bg-white border-t border-gray-100">
                <form id="chat-form" class="relative max-w-5xl mx-auto">
                    <input type="hidden" id="session-id" value="{{ $session->id }}">
                    <input type="hidden" id="last-question-id" value="{{ $session->questions->last()->id ?? '' }}">

                    <input type="text" id="answer-input" autocomplete="off" placeholder="Type your response carefully..."
                        class="w-full bg-gray-50 border border-gray-200 text-gray-800 text-sm rounded-xl py-4 pl-6 pr-16 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition transition-shadow">

                    <button type="submit" id="send-btn"
                        class="absolute right-2 top-2  bottom-2 px-5 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-medium text-sm transition-colors flex items-center gap-2 group shadow-sm">
                        Send <i class="fas fa-paper-plane group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>
            </div>
        @else
            <!-- Result Console Lock -->
            <div class="p-6 bg-green-50 border-t border-green-100 text-center">
                <h4 class="font-bold text-green-800 text-lg mb-2">Interview Concluded!</h4>
                <p class="text-green-700 text-sm max-w-2xl mx-auto mb-4">The AI has gathered enough data mapping to an
                    explosive {{ $session->confidence_score }}% confidence matching threshold. Below is your formal
                    architecture.</p>
                <!-- Render Out AI Schema directly -->
                @if($session->recommendation)
                    <div
                        class="bg-white rounded-xl shadow-sm border border-green-200 p-6 text-left max-w-3xl mx-auto flex flex-col gap-4">
                        <div>
                            <span class="text-xs uppercase tracking-widest text-gray-400 font-bold">Best Field of Study</span>
                            <h2 class="text-xl font-bold text-gray-800">{{ $session->recommendation->field_of_study }}</h2>
                        </div>
                        <div class="h-px w-full bg-gray-100"></div>
                        <div>
                            <span class="text-xs uppercase tracking-widest text-gray-400 font-bold">Target Path</span>
                            <h3 class="text-lg font-bold text-[#1e3a8a]">{{ $session->recommendation->recommended_course }}</h3>
                        </div>
                        <div class="h-px w-full bg-gray-100"></div>
                        <div>
                            <span class="text-xs uppercase tracking-widest text-gray-400 font-bold mb-2 block">Identified
                                Strengths</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach($session->recommendation->strengths ?? [] as $s)
                                    <span
                                        class="px-3 py-1 bg-green-50 text-green-700 font-bold text-xs rounded-full">{{ $s }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="mt-2 p-4 bg-blue-50 text-blue-900 rounded-lg text-sm border border-blue-100 italic">
                            "{{ $session->recommendation->reasoning }}"
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>

    <!-- Inject Ajax Scripts directly inside layout -->
    @if($session->status === 'in_progress')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const thread = document.getElementById('chat-thread');
                const typing = document.getElementById('typing-indicator');
                const answerInput = document.getElementById('answer-input');
                const lastQuestionSpan = document.getElementById('last-question-id');

                function scrollToBottom() {
                    thread.scrollTop = thread.scrollHeight;
                }
                scrollToBottom();

                // If completely fresh session, immediately POST to trigger the first greeting string.
                if ('{{ $session->questions->count() }}' === '0') {
                    triggerOpenAI('');
                }

                document.getElementById('chat-form').addEventListener('submit', function (e) {
                    e.preventDefault();
                    let text = answerInput.value.trim();

                    if (!text) return; // ignore blank

                    let studentInitial = '{{ substr(auth()->user()->name ?? 'U', 0, 1) }}';

                    // Instantly Append their own message locally to thread for blazing aesthetics
                    let html = `
                        <div class="flex gap-4 items-end self-end max-w-3xl flex-row-reverse slide-up">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shadow-sm shrink-0 font-bold">
                                ${studentInitial}
                            </div>
                            <div class="bg-blue-600 border border-blue-700 p-4 rounded-2xl rounded-br-sm shadow-sm text-white text-sm leading-relaxed">
                                ${text}
                            </div>
                        </div>
                    `;
                    typing.insertAdjacentHTML('beforebegin', html);
                    answerInput.value = '';
                    scrollToBottom();

                    // Fire off the API to store the answer AND fetch the followup
                    triggerOpenAI(text);
                });

                async function triggerOpenAI(answerText) {
                    typing.classList.remove('hidden');
                    scrollToBottom();

                    answerInput.disabled = true;

                    let data = {
                        session_id: document.getElementById('session-id').value,
                        answer_text: answerText,
                        question_id: lastQuestionSpan.value,
                        _token: '{{ csrf_token() }}'
                    };

                    try {
                        let res = await fetch("{{ route('student.ai.store') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(data)
                        });

                        let payload = await res.json();
                        typing.classList.add('hidden');

                        if (payload.error) {
                            alert(payload.error);
                            window.location.reload();
                            return;
                        }

                        if (payload.status === 'completed') {
                            // The AI terminated the session and issued a JSON. We reload the exact page to let Laravel natively render the green completion screen.
                            window.location.reload();
                        } else {
                            // Status is in-progress. The AI returned a question schema. 
                            lastQuestionSpan.value = payload.question.id;

                            let qHtml = `
                                <div class="flex gap-4 items-end slide-up max-w-3xl">
                                    <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center shadow-sm shrink-0">
                                        <i class="fas fa-robot"></i>
                                    </div>
                                    <div class="bg-white border border-gray-200 p-4 rounded-2xl rounded-bl-sm shadow-sm text-gray-700 text-sm leading-relaxed">
                                        ${payload.question.question_text}
                                    </div>
                                </div>
                            `;
                            typing.insertAdjacentHTML('beforebegin', qHtml);
                            answerInput.disabled = false;
                            answerInput.focus();
                            scrollToBottom();
                        }
                    } catch (e) {
                        typing.classList.add('hidden');
                        alert("System failed to hit AI endpoint. Are your API keys registered?");
                        answerInput.disabled = false;
                    }
                }
            });
        </script>
        <style>
            .slide-up {
                animation: slideUp 0.3s ease-out forwards;
            }

            @keyframes slideUp {
                0% {
                    transform: translateY(10px);
                    opacity: 0;
                }

                100% {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            .bounce-delay-1 {
                animation: bounce 1.4s infinite ease-in-out both;
                animation-delay: -0.32s;
            }

            .bounce-delay-2 {
                animation: bounce 1.4s infinite ease-in-out both;
                animation-delay: -0.16s;
            }

            .bounce-delay-3 {
                animation: bounce 1.4s infinite ease-in-out both;
            }

            @keyframes bounce {

                0%,
                80%,
                100% {
                    transform: scale(0);
                }

                40% {
                    transform: scale(1);
                }
            }
        </style>
    @endif
</x-dashboard-layout>