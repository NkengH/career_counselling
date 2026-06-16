<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyCareerCoach') }}</title>

    <!-- Tailwind and App styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .custom-sidebar {
            background-color: #2752aa;
        }

        .custom-sidebar-active {
            background-color: #1a4290;
            border-left: 4px solid white;
        }

        .custom-sidebar-hover:hover {
            background-color: #1a4290;
        }

        .custom-text-muted {
            color: #8ea3d6;
        }
    </style>
</head>

<body
    class="font-sans text-gray-900 antialiased bg-gray-100 flex h-screen overflow-hidden selection:bg-blue-600 selection:text-white">

    <!-- Sidebar Wrapper -->
    <div x-data="{ sidebarOpen: false }" class="flex w-full h-full">

        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen"
            class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm lg:hidden flex transition-opacity"
            x-transition.opacity @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-72 custom-sidebar text-white flex flex-col transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-auto">

            <!-- Brand -->
            <div class="h-20 flex items-center px-6 mb-2">
                <a href="/dashboard" class="flex items-center gap-3">
                    <div class="flex items-center justify-center p-2 rounded-lg bg-white/10">
                        <i class="fas fa-graduation-cap text-white text-xl"></i>
                    </div>
                    <div>
                        <span
                            class="text-xl font-bold tracking-tight leading-tight block uppercase">MYCAREERCOACH</span>
                        <span class="text-[0.6rem] text-blue-200 uppercase tracking-widest block -mt-1">Right Choice,
                            Right Future</span>
                    </div>
                </a>
            </div>

            <!-- User Profile snippet -->
            <div class="px-6 mb-6 pb-6 border-b border-white/10 flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-blue-400 text-white flex items-center justify-center font-bold shadow-md ring-2 ring-white/20">
                    MS
                </div>
                <div>
                    <h6 class="font-semibold text-sm leading-tight">{{ auth()->user()->name ?? 'michelle student' }}
                    </h6>
                    <p class="custom-text-muted text-xs">he/him</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto">
                <a href="{{ route('student.dashboard') }}"
                    class="custom-sidebar-active text-white px-4 py-3 rounded-lg flex items-center gap-3 font-medium text-sm transition-colors">
                    <i class="fas fa-th-large w-5 text-center text-white/90"></i> Dashboard
                </a>

                <a href="{{ route('student.appointments.create') }}"
                    class="text-white/80 custom-sidebar-hover px-4 py-3 rounded-lg flex items-center gap-3 font-medium text-sm transition-colors">
                    <i class="far fa-calendar-alt w-5 text-center"></i> Book Counselor
                </a>

                <a href="#"
                    class="text-white/80 custom-sidebar-hover px-4 py-3 rounded-lg flex items-center gap-3 font-medium text-sm transition-colors">
                    <i class="fas fa-upload w-5 text-center"></i> Upload Records
                </a>

                <a href="{{ route('student.tests.index') }}"
                    class="text-white/80 custom-sidebar-hover px-4 py-3 rounded-lg flex items-center gap-3 font-medium text-sm transition-colors">
                    <i class="fas fa-clipboard-list w-5 text-center"></i> Career Assessment
                </a>

                <a href="{{ route('student.ai.chat') }}"
                    class="{{ request()->routeIs('student.ai.chat') ? 'bg-blue-600/20 text-[#2563eb] border-l-4 border-blue-600' : 'text-white/80 hover:bg-white/10' }} custom-sidebar-hover px-4 py-3 rounded-lg flex items-center justify-between font-medium text-sm transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-robot w-5 text-center text-orange-400"></i> AI Counselor
                    </div>
                </a>

                <a href="#"
                    class="text-white/80 custom-sidebar-hover px-4 py-3 rounded-lg flex items-center gap-3 font-medium text-sm transition-colors">
                    <i class="far fa-lightbulb w-5 text-center"></i> System Recommendations
                </a>

                <a href="{{ route('messages.index') }}"
                    class="text-white/80 custom-sidebar-hover px-4 py-3 rounded-lg flex items-center justify-between font-medium text-sm transition-colors">
                    <div class="flex items-center gap-3">
                        <i class="far fa-envelope w-5 text-center"></i> Messages
                    </div>
                </a>

                <a href="#"
                    class="text-white/80 custom-sidebar-hover px-4 py-3 rounded-lg flex items-center gap-3 font-medium text-sm transition-colors">
                    <i class="fas fa-cog w-5 text-center"></i> Settings
                </a>
            </nav>

            <!-- Bottom action -->
            <div class="p-4 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-white/80 hover:text-white px-4 py-3 flex items-center gap-3 font-medium text-sm transition-colors custom-sidebar-hover rounded-lg">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50">
            <!-- Topbar Custom -->
            <header class="h-20 bg-gray-50 flex items-center justify-between px-8 shrink-0">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="lg:hidden text-gray-400 hover:text-gray-600 mr-4">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <!-- Logo / Search / Info text -->
                    <div class="flex items-center gap-2 text-xl font-bold text-gray-800 tracking-tight uppercase">
                        <span>MYCAREER</span><span class="text-blue-500">COACH</span>
                    </div>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center gap-8">
                    <a href="#"
                        class="text-gray-500 hover:text-gray-700 font-medium text-sm hidden md:block">Explore</a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 font-medium text-sm hidden md:block">Book a
                        Counselor</a>

                    <!-- Avatar / Dropdown -->
                    <div class="relative items-center gap-3 hidden sm:flex">
                        <button class="flex items-center justify-center w-10 h-10 rounded-xl bg-[#0f172a] text-white">
                            <i class="fas fa-user text-sm"></i>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Page Content scrollable -->
            <div class="flex-1 overflow-auto p-8 relative">
                <!-- Inner content wrapper -->
                <div class="max-w-6xl mx-auto space-y-6">
                    @if (isset($header))
                        <!-- You can conditionally show $header if desired, but in the mockup there's no page title, just the cards -->
                    @endif

                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>

</html>