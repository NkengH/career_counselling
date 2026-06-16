@php
    $layout = auth()->user()->role === 'counsellor' ? 'counsellor-dashboard-layout' : 'dashboard-layout';
@endphp

<x-dynamic-component :component="$layout">
    <div class="flex h-[calc(100vh-8rem)] bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Sidebar Contacts -->
        <div class="w-1/3 border-r border-gray-100 bg-gray-50/30 flex flex-col">
            <div class="p-4 border-b border-gray-100 bg-white shadow-sm z-10 shrink-0">
                <h3 class="font-bold text-gray-800 text-lg">Inbox</h3>
            </div>
            <div class="flex-1 overflow-y-auto">
                @forelse($contacts as $contact)
                    <a href="{{ route('messages.show', $contact->id) }}"
                        class="block p-4 border-b border-gray-100 hover:bg-gray-100 transition {{ isset($activeContact) && $activeContact->id === $contact->id ? 'bg-blue-50 border-l-4 border-[#1e3a8a]' : '' }}">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden border border-gray-300">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($contact->name) }}&background=e2e8f0&color=475569"
                                    alt="User">
                            </div>
                            <div>
                                <h6 class="font-semibold text-sm text-gray-800 leading-tight">{{ $contact->name }}</h6>
                                <p class="text-[0.65rem] text-gray-500 uppercase tracking-widest mt-0.5">
                                    {{ $contact->role }}</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="p-8 text-center text-gray-400">
                        <i class="far fa-address-book text-3xl mb-3 text-gray-300 block"></i>
                        <span class="text-xs font-medium">No active conversation contacts. Book or approve an appointment to
                            unlock direct messaging.</span>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Distributed Chat Area -->
        <div class="w-2/3 flex flex-col bg-white">
            @if($activeContact)
                <!-- Target Header -->
                <div class="p-4 border-b border-gray-100 flex items-center gap-3 shrink-0 shadow-sm z-10 bg-white">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($activeContact->name) }}&background=e2e8f0&color=475569"
                        class="w-10 h-10 rounded-full border border-gray-200 shadow-sm" alt="User">
                    <div>
                        <h4 class="font-bold text-gray-800 leading-none">{{ $activeContact->name }}</h4>
                        <span
                            class="text-[0.65rem] uppercase font-bold text-gray-400 tracking-wide">{{ $activeContact->role }}</span>
                    </div>
                </div>

                <!-- Core Messages Thread -->
                <div class="flex-1 overflow-y-auto p-6 space-y-5 bg-gray-50/50" id="chat-container">
                    @forelse($messages as $message)
                        <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div
                                class="max-w-[75%] px-5 py-2.5 shadow-sm {{ $message->sender_id === auth()->id() ? 'bg-[#1e3a8a] text-white rounded-2xl rounded-br-sm' : 'bg-white border border-gray-200 text-gray-800 rounded-2xl rounded-bl-sm' }}">
                                <p class="text-sm leading-relaxed">{{ $message->content }}</p>
                                <span
                                    class="text-[0.6rem] {{ $message->sender_id === auth()->id() ? 'text-blue-200' : 'text-gray-400' }} block mt-1 text-right font-medium tracking-wide">{{ $message->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="flex-1 flex flex-col items-center justify-center text-gray-400 h-full">
                            <i class="far fa-comments text-5xl mb-4 text-gray-200"></i>
                            <p class="text-sm font-medium">This is the start of your encrypted conversation with
                                {{ $activeContact->name }}. Say hi!</p>
                        </div>
                    @endforelse
                </div>

                <!-- Chat Input System -->
                <div class="p-4 bg-white border-t border-gray-100 shrink-0">
                    <form action="{{ route('messages.store', $activeContact->id) }}" method="POST"
                        class="flex items-center gap-3">
                        @csrf
                        <input type="text" name="content" placeholder="Type a professional message..."
                            class="flex-1 bg-gray-50 border border-gray-200 rounded-xl px-5 py-3 text-sm shadow-inner focus:outline-none focus:ring-2 focus:ring-[#1e3a8a] focus:bg-white transition-all"
                            required autofocus autocomplete="off">
                        <button type="submit"
                            class="bg-[#1e3a8a] hover:bg-blue-900 text-white rounded-xl px-6 py-3 font-bold text-sm transition shadow-sm flex items-center justify-center shrink-0">
                            Send <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </form>
                </div>

                <script>
                    var chatContainer = document.getElementById("chat-container");
                    if (chatContainer) chatContainer.scrollTop = chatContainer.scrollHeight;
                </script>
            @else
                <div class="flex-1 flex flex-col items-center justify-center text-gray-400 bg-gray-50/50">
                    <div
                        class="w-20 h-20 bg-white border border-gray-100 shadow-sm text-gray-300 rounded-full flex flex-col items-center justify-center mb-6 text-3xl">
                        <i class="far fa-paper-plane"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2">Your Conversations</h3>
                    <p class="font-medium text-sm text-gray-500 max-w-xs text-center leading-relaxed">Select a conversation
                        partner from the side menu to instantly start messaging safely.</p>
                </div>
            @endif
        </div>
    </div>
</x-dynamic-component>