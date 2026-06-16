<x-admin-dashboard-layout>
    <x-slot name="header">
        Admin Dashboard <span class="text-gray-500 text-base font-normal ml-2">Overview</span>
    </x-slot>

    <!-- Stats Widgets -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="glass-panel p-6 group hover:-translate-y-1 transition-transform">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h6 class="text-gray-500 font-medium text-sm mb-1">Total Users</h6>
                    <h2 class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_users']) }}</h2>
                </div>
                <div
                    class="w-12 h-12 bg-primary-50 text-primary-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
            <div>
                <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-primary-500 h-1.5 rounded-full" style="width: 100%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-2 font-medium">Includes Students, Admins & Counsellors</p>
            </div>
        </div>

        <div class="glass-panel p-6 group hover:-translate-y-1 transition-transform">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h6 class="text-gray-500 font-medium text-sm mb-1">Appointments</h6>
                    <h2 class="text-3xl font-bold text-gray-800">{{ number_format($stats['appointments']) }}</h2>
                </div>
                <div
                    class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
            </div>
            <div>
                <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-emerald-500 h-1.5 rounded-full" style="width: 100%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-2 font-medium">All time sessions booked</p>
            </div>
        </div>

        <div class="glass-panel p-6 group hover:-translate-y-1 transition-transform">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h6 class="text-gray-500 font-medium text-sm mb-1">Tests Completed</h6>
                    <h2 class="text-3xl font-bold text-gray-800">{{ number_format($stats['tests_completed']) }}</h2>
                </div>
                <div
                    class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="fas fa-tasks text-xl"></i>
                </div>
            </div>
            <div>
                <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-amber-500 h-1.5 rounded-full" style="width: 100%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-2 font-medium">Total aptitude history generated</p>
            </div>
        </div>

        <div class="glass-panel p-6 group hover:-translate-y-1 transition-transform">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <h6 class="text-gray-500 font-medium text-sm mb-1">Careers Indexed</h6>
                    <h2 class="text-3xl font-bold text-gray-800">{{ number_format($stats['careers']) }}</h2>
                </div>
                <div
                    class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="fas fa-briefcase text-xl"></i>
                </div>
            </div>
            <div>
                <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-cyan-500 h-1.5 rounded-full" style="width: 100%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-2 font-medium">Database currently tracked</p>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 glass-panel p-6">
            <h5 class="font-bold text-lg text-gray-800 mb-6">User Growth Analytics</h5>
            <!-- Placeholder for Chart -->
            <div
                class="flex items-center justify-center bg-gray-50/50 rounded-xl border border-dashed border-gray-200 h-72">
                <div class="text-center text-gray-400">
                    <i class="fas fa-chart-area text-5xl mb-4 text-primary-200"></i>
                    <p class="font-medium">Graphical representation goes here.</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1 glass-panel p-6">
            <h5 class="font-bold text-lg text-gray-800 mb-6">Career Matches</h5>
            <!-- Placeholder for Pie Chart -->
            <div
                class="flex items-center justify-center bg-gray-50/50 rounded-xl border border-dashed border-gray-200 h-72">
                <div class="text-center text-gray-400">
                    <i class="fas fa-chart-pie text-5xl mb-4 text-amber-200"></i>
                    <p class="font-medium">AI Match Distribution</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Empty State -->
    <div class="glass-panel p-6">
        <h5 class="font-bold text-lg text-gray-800 mb-6">Recent Activities</h5>
        <div class="flex flex-col items-center justify-center py-10">
            <div
                class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 shadow-inner border border-gray-100">
                <i class="fas fa-folder-open text-3xl text-gray-300"></i>
            </div>
            <h6 class="font-bold text-gray-500 text-lg">No recent activities</h6>
            <p class="text-gray-400 text-sm mt-1">When users take tests or book appointments, they will track here.</p>
        </div>
    </div>
</x-admin-dashboard-layout>