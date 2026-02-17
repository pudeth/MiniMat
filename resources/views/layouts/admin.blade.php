<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KKD Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/khmer-fonts.css') }}">
    
    <!-- Khmer Font Support -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Khmer+OS+Dangrek&display=swap" rel="stylesheet">
    <style>
        /* Classic UI Styles - Traditional Desktop Application Look */
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: #e8e8e8;
        }
        
        /* Khmer Font Classes */
        .khmer-text {
            font-family: 'Khmer OS Dangrek', serif;
            font-weight: normal;
            line-height: 1.6;
        }
        
        .khmer-title {
            font-family: 'Khmer OS Dangrek', serif;
            font-weight: bold;
            line-height: 1.4;
        }
        
        .khmer-small {
            font-family: 'Khmer OS Dangrek', serif;
            font-size: 0.875rem;
            line-height: 1.5;
        }
        
        .khmer-large {
            font-family: 'Khmer OS Dangrek', serif;
            font-size: 1.25rem;
            font-weight: bold;
            line-height: 1.3;
        }
        
        /* Mixed text support (English + Khmer) */
        .mixed-text {
            font-family: 'Khmer OS Dangrek', serif, 'Segoe UI', Tahoma, sans-serif;
        }
        
        /* Ensure proper rendering for Khmer characters */
        .khmer-text, .khmer-title, .khmer-small, .khmer-large, .mixed-text {
            text-rendering: optimizeLegibility;
            -webkit-font-feature-settings: "liga" 1, "calt" 1;
            font-feature-settings: "liga" 1, "calt" 1;
        }
        
        /* Classic Card with Beveled Border */
        .neo-card {
            background: #ffffff;
            border: 1px solid #c0c0c0;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #808080;
            border-bottom-color: #808080;
            box-shadow: inset 1px 1px 0 rgba(255,255,255,0.8), 
                        inset -1px -1px 0 rgba(0,0,0,0.2);
        }
        
        .neo-card:hover {
            border-color: #a0a0a0;
        }
        
        /* Classic Button with 3D Effect */
        .neo-btn {
            background: linear-gradient(180deg, #f0f0f0 0%, #d4d4d4 100%);
            border: 1px solid #a0a0a0;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #808080;
            border-bottom-color: #808080;
            box-shadow: 1px 1px 0 rgba(255,255,255,0.8), 
                        inset 1px 1px 0 rgba(255,255,255,0.6);
            font-weight: 500;
            transition: all 0.1s ease;
            text-shadow: 0 1px 0 rgba(255,255,255,0.8);
        }
        
        .neo-btn:hover {
            background: linear-gradient(180deg, #f8f8f8 0%, #e0e0e0 100%);
        }
        
        .neo-btn:active {
            background: linear-gradient(180deg, #d0d0d0 0%, #e8e8e8 100%);
            border-top-color: #808080;
            border-left-color: #808080;
            border-right-color: #ffffff;
            border-bottom-color: #ffffff;
            box-shadow: inset 1px 1px 2px rgba(0,0,0,0.2);
        }
        
        /* Alternative button class */
        .neo-button {
            background: linear-gradient(180deg, #f0f0f0 0%, #d4d4d4 100%);
            border: 1px solid #a0a0a0;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #808080;
            border-bottom-color: #808080;
            box-shadow: 1px 1px 0 rgba(255,255,255,0.8), 
                        inset 1px 1px 0 rgba(255,255,255,0.6);
            font-weight: 500;
            transition: all 0.1s ease;
            text-shadow: 0 1px 0 rgba(255,255,255,0.8);
            display: inline-block;
            text-decoration: none;
            color: #000;
        }
        
        .neo-button:hover {
            background: linear-gradient(180deg, #f8f8f8 0%, #e0e0e0 100%);
        }
        
        .neo-button:active {
            background: linear-gradient(180deg, #d0d0d0 0%, #e8e8e8 100%);
            border-top-color: #808080;
            border-left-color: #808080;
            border-right-color: #ffffff;
            border-bottom-color: #ffffff;
            box-shadow: inset 1px 1px 2px rgba(0,0,0,0.2);
        }
        
        /* Primary Button */
        .neo-btn.btn-primary {
            background: linear-gradient(180deg, #4a90e2 0%, #2e5f9e 100%);
            border-color: #1e4d7f;
            color: white;
            text-shadow: 0 -1px 0 rgba(0,0,0,0.3);
        }
        
        .neo-btn.btn-primary:hover {
            background: linear-gradient(180deg, #5a9ff2 0%, #3e6fae 100%);
        }
        
        .neo-btn.btn-primary:active {
            background: linear-gradient(180deg, #2e5f9e 0%, #4a90e2 100%);
        }
        
        /* Classic Input with Inset Effect */
        .neo-input {
            background: #ffffff;
            border: 1px solid #808080;
            border-top-color: #404040;
            border-left-color: #404040;
            border-right-color: #c0c0c0;
            border-bottom-color: #c0c0c0;
            box-shadow: inset 1px 1px 2px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
        }
        
        .neo-input:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: inset 1px 1px 2px rgba(0,0,0,0.1),
                        0 0 0 2px rgba(74, 144, 226, 0.2);
        }
        
        /* Classic Sidebar */
        .neo-sidebar {
            background: linear-gradient(180deg, #4a5568 0%, #2d3748 100%);
            border-right: 1px solid #1a202c;
            box-shadow: inset -1px 0 0 rgba(255,255,255,0.1);
        }
        
        .neo-sidebar-item {
            border: 1px solid transparent;
            transition: all 0.15s ease;
            margin: 2px 0;
        }
        
        .neo-sidebar-item:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.1);
        }
        
        .neo-sidebar-item.active {
            background: linear-gradient(180deg, #4a90e2 0%, #2e5f9e 100%);
            border: 1px solid #1e4d7f;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),
                        0 1px 2px rgba(0,0,0,0.3);
        }
        
        /* Classic Stat Card with Raised Effect */
        .neo-stat-card {
            background: #ffffff;
            border: 1px solid #c0c0c0;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #808080;
            border-bottom-color: #808080;
            box-shadow: 2px 2px 4px rgba(0,0,0,0.15),
                        inset 1px 1px 0 rgba(255,255,255,0.8);
            transition: all 0.2s ease;
        }
        
        .neo-stat-card:hover {
            box-shadow: 3px 3px 6px rgba(0,0,0,0.2),
                        inset 1px 1px 0 rgba(255,255,255,0.8);
            transform: translateY(-1px);
        }
        
        /* Classic Table */
        .neo-table {
            border: 1px solid #c0c0c0;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .neo-table th {
            background: linear-gradient(180deg, #e8e8e8 0%, #d0d0d0 100%);
            border: 1px solid #a0a0a0;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            color: #000000;
            font-weight: 600;
            text-transform: none;
            font-size: 0.875rem;
            padding: 8px 12px;
            text-shadow: 0 1px 0 rgba(255,255,255,0.8);
        }
        
        .neo-table td {
            border-bottom: 1px solid #d0d0d0;
            border-right: 1px solid #e8e8e8;
            background: #ffffff;
        }
        
        .neo-table tbody tr:hover td {
            background: #f0f8ff;
        }
        
        .neo-table tr:last-child td {
            border-bottom: none;
        }
        
        /* Classic Badge */
        .neo-badge {
            border: 1px solid #a0a0a0;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
            border-right-color: #808080;
            border-bottom-color: #808080;
            font-weight: 500;
            font-size: 0.75rem;
            padding: 2px 8px;
            text-shadow: 0 1px 0 rgba(255,255,255,0.5);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.4);
        }
        
        /* Classic Header with Gradient */
        .neo-header {
            background: linear-gradient(180deg, #5a6c7d 0%, #3d4a56 100%);
            border-bottom: 1px solid #2a3440;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2),
                        inset 0 1px 0 rgba(255,255,255,0.1);
        }
        
        /* Classic Color Palette */
        .bg-neo-yellow { background: linear-gradient(180deg, #fff9e6 0%, #ffe9a0 100%); }
        .bg-neo-pink { background: linear-gradient(180deg, #ffe6f0 0%, #ffb3d9 100%); }
        .bg-neo-blue { background: linear-gradient(180deg, #e6f2ff 0%, #b3d9ff 100%); }
        .bg-neo-green { background: linear-gradient(180deg, #e6ffe6 0%, #b3ffb3 100%); }
        .bg-neo-purple { background: linear-gradient(180deg, #f0e6ff 0%, #d9b3ff 100%); }
        .bg-neo-orange { background: linear-gradient(180deg, #fff0e6 0%, #ffd9b3 100%); }
        
        /* Panel/Fieldset Style */
        .classic-panel {
            background: #f0f0f0;
            border: 2px groove #d0d0d0;
            padding: 12px;
        }
        
        .classic-panel-header {
            background: linear-gradient(90deg, #003d7a 0%, #0066cc 100%);
            color: white;
            padding: 4px 8px;
            font-weight: bold;
            font-size: 0.875rem;
            text-shadow: 1px 1px 1px rgba(0,0,0,0.5);
        }
        
        /* Scrollbar Classic Style */
        ::-webkit-scrollbar {
            width: 16px;
            height: 16px;
        }
        
        ::-webkit-scrollbar-track {
            background: #d0d0d0;
            border: 1px solid #a0a0a0;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #e8e8e8 0%, #c0c0c0 100%);
            border: 1px solid #a0a0a0;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #f0f0f0 0%, #d0d0d0 100%);
        }
        
        ::-webkit-scrollbar-button {
            background: linear-gradient(180deg, #e8e8e8 0%, #c0c0c0 100%);
            border: 1px solid #a0a0a0;
            border-top-color: #ffffff;
            border-left-color: #ffffff;
        }
        
        /* Animations */
        .float-animation {
            animation: none;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-200">
    @if(auth()->check() && auth()->user()->role !== 'admin')
        <!-- Redirect cashiers who somehow accessed admin pages -->
        <script>window.location.href = "{{ route('pos.index') }}";</script>
    @endif
    
    <div class="flex h-screen overflow-hidden">
        <!-- Neo-Brutalism Sidebar -->
        <aside class="w-72 neo-sidebar text-white flex-shrink-0">
            <div class="p-5 border-b border-gray-800" style="background: linear-gradient(180deg, #5a6c7d 0%, #4a5568 100%);">
                @php
                    $storeName = \App\Models\StoreSetting::get('store_name', 'KKD');
                    $storeTagline = \App\Models\StoreSetting::get('store_tagline', 'KHQR PAYMENT SYSTEM');
                    $storeLogo = \App\Models\StoreSetting::get('store_logo');
                @endphp
                
                <div class="flex items-center space-x-3">
                    @if($storeLogo)
                        <img src="{{ asset('storage/' . $storeLogo) }}" 
                             alt="Store Logo" 
                             class="h-10 w-10 object-cover" 
                             style="border: 2px solid #ffffff; box-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                    @endif
                    <div>
                        <h1 class="text-lg font-semibold text-white" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">{{ $storeName }}</h1>
                        <p class="text-xs text-gray-300">{{ $storeTagline }}</p>
                    </div>
                </div>
            </div>
            <nav class="mt-3 px-3 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="neo-sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }} block px-3 py-2.5 text-sm font-medium text-white">
                    <i class="fas fa-chart-line mr-2 w-4"></i> Dashboard
                </a>
                <a href="{{ route('pos.index') }}" class="neo-sidebar-item block px-3 py-2.5 text-sm font-medium text-white">
                    <i class="fas fa-cash-register mr-2 w-4"></i> POS System
                </a>
                <a href="{{ route('admin.sales') }}" class="neo-sidebar-item {{ request()->routeIs('admin.sales') ? 'active' : '' }} block px-3 py-2.5 text-sm font-medium text-white">
                    <i class="fas fa-receipt mr-2 w-4"></i> Sales
                </a>
                <a href="{{ route('admin.products') }}" class="neo-sidebar-item {{ request()->routeIs('admin.products') ? 'active' : '' }} block px-3 py-2.5 text-sm font-medium text-white">
                    <i class="fas fa-box mr-2 w-4"></i> Products
                </a>
                <a href="{{ route('admin.categories') }}" class="neo-sidebar-item {{ request()->routeIs('admin.categories') ? 'active' : '' }} block px-3 py-2.5 text-sm font-medium text-white">
                    <i class="fas fa-tags mr-2 w-4"></i> Categories
                </a>
                <a href="{{ route('admin.customers') }}" class="neo-sidebar-item {{ request()->routeIs('admin.customers*') ? 'active' : '' }} block px-3 py-2.5 text-sm font-medium text-white">
                    <i class="fas fa-users mr-2 w-4"></i> Customers
                </a>
                <a href="{{ route('admin.cashiers') }}" class="neo-sidebar-item {{ request()->routeIs('admin.cashiers*') ? 'active' : '' }} block px-3 py-2.5 text-sm font-medium text-white">
                    <i class="fas fa-user-tie mr-2 w-4"></i> Cashiers
                </a>
                <a href="{{ route('admin.settings') }}" class="neo-sidebar-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }} block px-3 py-2.5 text-sm font-medium text-white">
                    <i class="fas fa-cog mr-2 w-4"></i> Settings
                </a>
                <div class="mt-6 pt-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="neo-sidebar-item w-full text-left px-3 py-2.5 text-sm font-medium text-white hover:bg-red-700">
                            <i class="fas fa-sign-out-alt mr-2 w-4"></i> Logout
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Neo-Brutalism Header -->
            <header class="neo-header sticky top-0 z-10">
                <div class="px-6 py-3 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-white" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">@yield('header', 'Dashboard')</h2>
                        <p class="text-xs text-gray-300">{{ now()->format('l, F j, Y') }}</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="neo-card px-4 py-2" style="background: #f0f0f0;">
                            <p class="text-xs font-medium text-gray-600">Current Time</p>
                            <p class="text-base font-semibold text-gray-800" id="currentTime">{{ now()->format('H:i:s') }}</p>
                        </div>
                    </div>
                </div>
            </header>

            <main class="p-6">
                @if(session('success'))
                    <div class="neo-card mb-4 p-3" style="background: #d4edda; border-color: #c3e6cb;">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-700 text-lg mr-2"></i>
                            <span class="font-medium text-green-800 text-sm">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="neo-card mb-4 p-3" style="background: #f8d7da; border-color: #f5c6cb;">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-700 text-lg mr-2"></i>
                            <span class="font-medium text-red-800 text-sm">{{ session('error') }}</span>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
        // Update time every second
        setInterval(() => {
            const now = new Date();
            const timeStr = now.toLocaleTimeString('en-US', { hour12: false });
            const timeEl = document.getElementById('currentTime');
            if (timeEl) timeEl.textContent = timeStr;
        }, 1000);
    </script>
    @stack('scripts')
</body>
</html>
