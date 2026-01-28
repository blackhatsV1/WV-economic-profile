<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTI | @yield('title', 'Western Visayas Investment and Economic Profile')</title>
    <link rel="icon" type="image/png" href="/dti-logo.png">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Leaflet Maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>

<body>
    <div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleMobileMenu()"></div>
    <div class="dashboard-container">
        <button class="mobile-floating-trigger" id="mobile-floating-trigger" onclick="toggleMobileMenu()">
            <i data-lucide="menu"></i>
        </button>
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <button class="menu-trigger" onclick="toggleMobileMenu()">
                    <i data-lucide="menu"></i>
                </button>
                <div class="logo">
                    <i data-lucide="bar-chart-3" class="logo-icon"></i>
                    <span style="font-size: 0.9rem;">Western Visayas Investment and Economic Profile</span>
                </div>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('dashboard.regional-overview') }}"
                    class="nav-item {{ request()->routeIs('dashboard.regional-overview') ? 'active' : '' }}">
                    <i data-lucide="layout-dashboard"></i> <span>Regional Overview</span>
                </a>
                <a href="{{ route('dashboard.priority-industries') }}"
                    class="nav-item {{ request()->routeIs('dashboard.priority-industries') ? 'active' : '' }}">
                    <i data-lucide="star"></i> <span>Priority Industries</span>
                </a>
                <a href="{{ route('dashboard.industry-contribution') }}"
                    class="nav-item {{ request()->routeIs('dashboard.industry-contribution') ? 'active' : '' }}">
                    <i data-lucide="factory"></i> <span>Industry Contribution</span>
                </a>
                <a href="{{ route('dashboard.business-profile') }}"
                    class="nav-item {{ request()->routeIs('dashboard.business-profile') ? 'active' : '' }}">
                    <i data-lucide="briefcase"></i> <span>Business & Employment</span>
                </a>
                <a href="{{ route('dashboard.workforce-education') }}"
                    class="nav-item {{ request()->routeIs('dashboard.workforce-education') ? 'active' : '' }}">
                    <i data-lucide="graduation-cap"></i> <span>Workforce & Education</span>
                </a>
                <a href="{{ route('dashboard.infrastructure') }}"
                    class="nav-item {{ request()->routeIs('dashboard.infrastructure') ? 'active' : '' }}">
                    <i data-lucide="network"></i> <span>Infrastructure</span>
                </a>
            </nav>
            <div class="sidebar-footer">
                <p>Source: PSA & DTI VI</p>
            </div>
        </aside>

        <main class="main-content">
            <header class="top-header">
                <div class="header-left">
                    <h1>@yield('page-title')</h1>
                </div>
                <div class="header-right" style="display: flex; align-items: center; gap: 20px;">
                    <form method="GET" action="{{ url()->current() }}"
                        style="display: flex; align-items: center; gap: 8px;">
                        <select name="year" onchange="this.form.submit()"
                            style="background: rgba(255, 255, 255, 0.05); color: var(--text-primary); border: 1px solid var(--border); padding: 6px 12px; border-radius: 6px; outline: none; cursor: pointer; font-family: 'Outfit', sans-serif;">
                            @foreach(range(date('Y') + 1, 2020) as $y)
                                <option value="{{ $y }}" {{ request('year', 2024) == $y ? 'selected' : '' }}
                                    style="background: #1e293b;">{{ $y }}</option>
                            @endforeach
                        </select>
                    </form>
                    <span class="date">{{ now()->format('F d, Y') }}</span>
                    <img src="/dti-logo.png" alt="DTI Logo"
                        style="height: 45px; width: auto; background: white; border-radius: 6px; padding: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
                </div>
            </header>

            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const mainContent = document.querySelector('.main-content');
            const trigger = document.getElementById('mobile-floating-trigger');

            if (window.innerWidth <= 1024) {
                // Mobile behavior: Slide in/out with overlay
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                trigger.style.opacity = sidebar.classList.contains('active') ? '0' : '1';
                trigger.style.pointerEvents = sidebar.classList.contains('active') ? 'none' : 'auto';
                // Ensure desktop classes are removed
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
            } else {
                // Desktop behavior: Shrink/Expand
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                // Ensure mobile classes are removed
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            }
        }
    </script>
    @yield('scripts')
</body>

</html>