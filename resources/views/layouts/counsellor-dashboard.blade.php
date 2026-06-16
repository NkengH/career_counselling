<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Counsellor Portal') }}</title>

    <!-- Tailwind and App styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .sidebar {
            background-color: #f8fafc;
            border-right: 1px solid #e2e8f0;
        }

        .sidebar-brand {
            background-color: #1e3a8a;
        }

        /* dark blue */
        .nav-link {
            color: #64748b;
        }

        .nav-link-active {
            color: #1e3a8a;
            font-weight: 600;
            background-color: #f1f5f9;
        }

        .nav-link:hover {
            background-color: #f1f5f9;
            color: #1e3a8a;
        }

        .badge-red {
            background-color: #ef4444;
            color: white;
        }
    </style>
</head>

<body
    class="font-sans text-gray-900 antialiased bg-[#e2e8f0] flex h-screen overflow-hidden selection:bg-blue-600 selection:text-white">

    <!-- Sidebar Wrapper -->
    <div x-data="{ sidebarOpen: false }" class="flex w-full h-full">

        <div x-show="sidebarOpen"
            class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm lg:hidden flex transition-opacity"
            x-transition.opacity @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-[17rem] sidebar flex flex-col transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-auto">

            <!-- Brand Block -->
            <div class="h-16 sidebar-brand flex items-center px-6 text-white shrink-0 shadow-sm">
                <a href="/dashboard" class="flex items-center gap-3">
                    <div
                        class="bg-white text-[#1e3a8a] text-sm font-bold w-6 h-6 flex items-center justify-center rounded">
                        C
                    </div>
                    <span class="text-base font-bold tracking-wide uppercase">MYCAREERCOACH</span>
                </a>
            </div>

            <!-- Profile Info -->
            <div class="px-6 py-6 flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden border border-gray-300">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Counselor') }}&background=e2e8f0&color=475569"
                        alt="User">
                </div>
                <div>
                    <h6 class="font-bold text-sm text-gray-800 leading-tight">{{ auth()->user()->name ?? 'Dr. Smith' }}
                    </h6>
                    <p class="text-xs text-gray-500 text-capitalize">Counsellor</p>
                </div>
            </div>

            <div class="px-4 mb-2">
                <p class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider mb-2 px-2">Menu</p>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
                <a href="{{ route('counsellor.dashboard') ?? '#' }}"
                    class="nav-link-active px-3 py-2.5 rounded-lg flex items-center gap-3 text-sm transition-colors">
                    <i class="fas fa-th-large w-4 text-center"></i> Dashboard
                </a>

                <a href="#"
                    class="nav-link px-3 py-2.5 rounded-lg flex items-center gap-3 font-medium text-sm transition-colors">
                    <i class="fas fa-user-graduate w-4 text-center"></i> Student Management
                </a>

                <a href="{{ route('counsellor.appointments.index') }}"
                    class="nav-link px-3 py-2.5 rounded-lg flex items-center justify-between font-medium text-sm transition-colors">
                    <span class="flex items-center gap-3"><i class="fas fa-calendar-alt w-4 text-center"></i>
                        Appointment</span>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span
                            class="badge-red text-[0.6rem] font-bold w-4 h-4 flex items-center justify-center rounded-full">{{ auth()->user()->unreadNotifications->count() }}</span>
                    @endif
                </a>

                <a href="{{ route('messages.index') }}"
                    class="nav-link px-3 py-2.5 rounded-lg flex items-center justify-between font-medium text-sm transition-colors">
                    <span class="flex items-center gap-3"><i class="fas fa-envelope w-4 text-center"></i>
                        Messages</span>
                    <span
                        class="badge-red text-[0.6rem] font-bold w-4 h-4 flex items-center justify-center rounded-full">0</span>
                </a>
            </nav>

            <!-- Bottom action -->
            <div class="p-4 mt-auto border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full nav-link px-3 py-2.5 flex items-center gap-3 font-medium text-sm transition-colors rounded-lg">
                        <i class="fas fa-sign-out-alt w-4 text-center"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Header (Mobile and Desktop) -->
            <header class="h-16 flex items-center justify-between px-6 shrink-0 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700 lg:hidden mr-4">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <!-- Desktop title -->
                    <span class="hidden lg:block font-bold text-gray-800 text-lg">Dashboard Overview</span>
                </div>

                <!-- Right Side Header (Notifications) -->
                <div class="flex items-center gap-5">
                    <!-- Notification Dropdown -->
                    <div x-data="{ notifyOpen: false }" class="relative">
                        <button @click="notifyOpen = !notifyOpen"
                            class="relative p-2 text-gray-500 hover:text-[#1e3a8a] transition flex items-center justify-center">
                            <i class="fas fa-bell text-xl"></i>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <span class="absolute top-1 right-1 flex h-2.5 w-2.5">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                                </span>
                            @endif
                        </button>

                        <div x-show="notifyOpen" @click.away="notifyOpen = false" x-transition
                            class="absolute right-0 mt-3 w-80 bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden z-50 py-2"
                            style="display: none;">
                            <div class="px-4 py-3 border-b border-gray-50 flex justify-between items-center">
                                <h3 class="text-sm font-bold text-gray-800">Notifications</h3>
                                <span
                                    class="text-[0.65rem] bg-red-100 text-red-600 px-2.5 py-0.5 rounded-full font-bold uppercase tracking-wider">{{ auth()->user()->unreadNotifications->count() }}
                                    new</span>
                            </div>
                            <div class="max-h-80 overflow-y-auto">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <div
                                        class="px-4 py-4 hover:bg-gray-50 border-b border-gray-50 transition cursor-pointer">
                                        <p class="text-xs text-gray-700 font-medium leading-relaxed">
                                            {{ $notification->data['message'] ?? 'New notification' }}
                                        </p>
                                        <span class="text-[0.65rem] text-gray-400 mt-2 flex items-center gap-1"><i
                                                class="far fa-clock"></i>
                                            {{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                @empty
                                    <div class="px-4 py-8 text-center flex flex-col items-center justify-center">
                                        <i class="fas fa-clipboard-check text-3xl text-gray-200 mb-3 block"></i>
                                        <p class="text-xs text-gray-400 font-medium">You're all caught up!</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content scrollable -->
            <div class="flex-1 overflow-auto p-4 md:p-8 bg-[#e2e8f0]">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>