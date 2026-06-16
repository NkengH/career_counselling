<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Decision Support System') }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Premium CSS -->
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
    <style>
        body {
            background-color: #f8f9fe;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .sidebar {
            min-width: 260px;
            max-width: 260px;
            background: #fff;
            color: #333;
            transition: all 0.3s;
            box-shadow: 2px 0 20px rgba(0, 0, 0, 0.05);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 20px;
            background: #fff;
            border-bottom: 1px solid #f1f1f1;
        }

        .sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #f1f1f1;
        }

        .sidebar ul p {
            padding: 10px;
            font-weight: 600;
            font-size: 0.85rem;
            color: #888;
            text-transform: uppercase;
            margin-bottom: 0;
        }

        .sidebar ul li a {
            padding: 12px 20px;
            font-size: 1.05em;
            display: block;
            color: #555;
            text-decoration: none;
            transition: 0.3s;
            border-left: 4px solid transparent;
        }

        .sidebar ul li a:hover,
        .sidebar ul li.active>a {
            color: var(--primary);
            background: rgba(var(--primary), 0.05);
            border-left-color: var(--primary);
            font-weight: 500;
        }

        .sidebar ul li a i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }

        #content {
            width: 100%;
            min-height: 100vh;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
        }

        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            transform: translate(30%, -30%);
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header d-flex align-items-center">
                <i class="fas fa-university text-primary fs-3 me-2"></i>
                <h4 class="mb-0 fw-bold text-gradient">MYCAREERCOACH</h4>
            </div>

            <ul class="list-unstyled components">
                <p>Menu</p>
                @if(auth()->user()->role === 'admin')
                    <li class="active">
                        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}"><i class="fas fa-user-circle"></i> Account Management</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-folder"></i> Academic Records</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-clipboard-list"></i> Assessments</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-cube"></i> Content Management</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-envelope"></i> Messages</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-cog"></i> Settings</a>
                    </li>
                @elseif(auth()->user()->role === 'counsellor')
                    <li class="active">
                        <a href="{{ route('counsellor.dashboard') }}"><i class="fas fa-chart-line"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-user-graduate"></i> Student Management</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-calendar-alt"></i> Appointments</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-envelope"></i> Messages</a>
                    </li>
                @elseif(auth()->user()->role === 'student')
                    <li class="active">
                        <a href="{{ route('student.dashboard') }}"><i class="fas fa-chart-pie"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-tasks"></i> My Aptitude Tests</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-lightbulb text-warning"></i> System Recommendations</a>
                    </li>
                    <li>
                        <a href="#"><i class="fas fa-calendar-check"></i> Book Counselling</a>
                    </li>
                @endif
            </ul>

            <ul class="list-unstyled components">
                <p>Settings</p>
                <li>
                    <a href="{{ route('profile.edit') }}"><i class="fas fa-user-cog"></i> Profile settings</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg top-navbar sticky-top">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-white shadow-sm border rounded">
                        <i class="fas fa-align-left text-primary"></i>
                    </button>

                    <div class="ms-auto d-flex align-items-center gap-3">
                        <!-- Notification Dropdown -->
                        <div class="dropdown">
                            <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-bell fs-5 text-muted"></i>
                                <span class="badge rounded-pill bg-danger notification-badge">3</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="width: 300px;">
                                <li>
                                    <h6 class="dropdown-header fw-bold text-dark">Notifications</h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item py-2" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                                                <i class="fas fa-info-circle"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-medium">System Update</p>
                                                <small class="text-muted">Welcome to MYCAREERCOACH!</small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li><a class="dropdown-item py-2" href="#">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle p-2 me-3">
                                                <i class="fas fa-magic"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0 fw-medium">System Ready</p>
                                                <small class="text-muted">Take a test to get started.</small>
                                            </div>
                                        </div>
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-center text-primary" href="#">View all</a></li>
                            </ul>
                        </div>

                        <!-- User Profile Dropdown -->
                        <div class="dropdown">
                            <a class="nav-link d-flex align-items-center gap-2" href="#" role="button"
                                data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random"
                                    rounded-circle width="35" height="35" class="rounded-circle shadow-sm">
                                <span class="fw-medium d-none d-md-block">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down ms-1" style="font-size:0.8rem;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li>
                                    <h6 class="dropdown-header text-capitalize">{{ Auth::user()->role }}</h6>
                                </li>
                                <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i
                                            class="fas fa-user-circle me-2 text-muted"></i> My Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger"><i
                                                class="fas fa-sign-out-alt me-2"></i> Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="container-fluid p-4" style="flex:1;">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @yield('content')
            </main>

            <footer class="mt-auto py-3 text-center text-muted small border-top">
                &copy; {{ date('Y') }} MYCAREERCOACH. All rights reserved.
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebarCollapse = document.getElementById('sidebarCollapse');
            const sidebar = document.querySelector('.sidebar');

            sidebarCollapse.addEventListener('click', function () {
                if (sidebar.style.display === 'none') {
                    sidebar.style.display = 'block';
                } else {
                    sidebar.style.display = 'none';
                }
            });
        });
    </script>
    @stack('scripts')
</body>

</html>