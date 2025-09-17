<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

     <body class="font-sans antialiased">
        <div class="loading-spinner" id="loadingSpinner">
            <i class="fas fa-spinner fa-spin fa-2x mb-2"></i>
            <br>Loading...
        </div>
        
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 page-content">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="page-content">
                {{ $slot }}
            </main>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
        
        <script>
            // Show loading spinner on page transitions
            function showLoading() {
                document.getElementById('loadingSpinner').style.display = 'block';
            }

            // Hide loading spinner
            function hideLoading() {
                document.getElementById('loadingSpinner').style.display = 'none';
            }

            // Add loading to all links
            document.addEventListener('DOMContentLoaded', function() {
                const links = document.querySelectorAll('a[href]:not([href^="#"]):not([href^="javascript:"]):not([target="_blank"])');
                links.forEach(link => {
                    link.addEventListener('click', function(e) {
                        if (!this.hasAttribute('data-no-loading')) {
                            showLoading();
                        }
                    });
                });

                // Hide loading when page loads
                hideLoading();

                // Add animation classes to cards
                const cards = document.querySelectorAll('.card');
                cards.forEach((card, index) => {
                    card.style.animationDelay = `${index * 0.1}s`;
                    card.classList.add('animate__animated', 'animate__fadeInUp');
                });

                // Add hover effects to buttons
                const buttons = document.querySelectorAll('.btn');
                buttons.forEach(button => {
                    button.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-2px)';
                    });
                    button.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0)';
                    });
                });

                // Auto-hide alerts after 5 seconds
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    setTimeout(() => {
                        alert.style.opacity = '0';
                        alert.style.transform = 'translateY(-20px)';
                        setTimeout(() => alert.remove(), 300);
                    }, 5000);
                });
            });

            // Add ripple effect to buttons
            function createRipple(event) {
                const button = event.currentTarget;
                const circle = document.createElement("span");
                const diameter = Math.max(button.clientWidth, button.clientHeight);
                const radius = diameter / 2;

                circle.style.width = circle.style.height = `${diameter}px`;
                circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
                circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
                circle.classList.add("ripple");

                const ripple = button.getElementsByClassName("ripple")[0];
                if (ripple) {
                    ripple.remove();
                }

                button.appendChild(circle);
            }

            // Add ripple CSS
            const rippleStyle = document.createElement('style');
            rippleStyle.textContent = `
                .ripple {
                    position: absolute;
                    border-radius: 50%;
                    transform: scale(0);
                    animation: ripple 600ms linear;
                    background-color: rgba(255, 255, 255, 0.6);
                }

                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(rippleStyle);

            // Apply ripple to all buttons
            document.addEventListener('DOMContentLoaded', function() {
                const buttons = document.querySelectorAll('.btn');
                buttons.forEach(button => {
                    button.addEventListener('click', createRipple);
                });
            });
        </script>
    </body>->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
        <style>
            :root {
                --primary-color: #dc3545;
                --secondary-color: #ffffff;
                --gradient-primary: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
                --gradient-secondary: linear-gradient(135deg, #6c757d 0%, #495057 100%);
                --shadow-soft: 0 8px 25px rgba(0,0,0,0.1);
                --shadow-strong: 0 15px 35px rgba(0,0,0,0.2);
            }

            body {
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                position: relative;
                overflow-x: hidden;
            }

            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(220,53,69,0.05)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
                z-index: -1;
                pointer-events: none;
            }

            .navbar-dark .navbar-nav .nav-link {
                color: var(--secondary-color);
                transition: all 0.3s ease;
                position: relative;
                padding: 0.5rem 1rem !important;
                margin: 0 0.2rem;
                border-radius: 8px;
            }

            .navbar-dark .navbar-nav .nav-link:hover {
                background: rgba(255,255,255,0.1);
                transform: translateY(-2px);
            }

            .navbar-dark .navbar-nav .nav-link::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                width: 0;
                height: 2px;
                background: var(--secondary-color);
                transition: all 0.3s ease;
                transform: translateX(-50%);
            }

            .navbar-dark .navbar-nav .nav-link:hover::after {
                width: 80%;
            }

            .btn-primary, .btn-danger {
                background: var(--gradient-primary);
                border: none;
                border-radius: 12px;
                padding: 0.6rem 1.5rem;
                font-weight: 600;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .btn-primary:hover, .btn-danger:hover {
                transform: translateY(-2px);
                box-shadow: var(--shadow-strong);
            }

            .btn-outline-danger {
                border: 2px solid var(--primary-color);
                color: var(--primary-color);
                border-radius: 12px;
                padding: 0.6rem 1.5rem;
                font-weight: 600;
                transition: all 0.3s ease;
                background: transparent;
            }

            .btn-outline-danger:hover {
                background: var(--gradient-primary);
                border-color: var(--primary-color);
                color: white;
                transform: translateY(-2px);
                box-shadow: var(--shadow-soft);
            }

            .card {
                border: none;
                border-radius: 20px;
                box-shadow: var(--shadow-soft);
                transition: all 0.3s ease;
                overflow: hidden;
                background: rgba(255,255,255,0.95);
                backdrop-filter: blur(10px);
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: var(--shadow-strong);
            }

            .card-header {
                border: none;
                border-radius: 20px 20px 0 0 !important;
                background: var(--gradient-primary) !important;
                color: white !important;
                padding: 1.5rem;
                position: relative;
            }

            .card-header::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 3px;
                background: linear-gradient(90deg, rgba(255,255,255,0.3), rgba(255,255,255,0.1), rgba(255,255,255,0.3));
            }

            .bg-danger {
                background: var(--gradient-primary) !important;
                color: var(--secondary-color) !important;
            }

            .text-danger {
                color: var(--primary-color) !important;
            }

            .table-bordered th {
                background: var(--gradient-primary) !important;
                color: var(--secondary-color) !important;
                border: none;
                padding: 1rem;
                font-weight: 600;
            }

            .table-striped > tbody > tr:nth-of-type(odd) > td {
                background-color: rgba(220,53,69,0.02);
            }

            .table-hover tbody tr:hover {
                background-color: rgba(220,53,69,0.05);
                transform: scale(1.01);
                transition: all 0.2s ease;
            }

            .badge {
                border-radius: 12px;
                padding: 0.5rem 1rem;
                font-weight: 500;
                font-size: 0.85rem;
            }

            .alert {
                border: none;
                border-radius: 15px;
                padding: 1.2rem 1.5rem;
                margin-bottom: 1.5rem;
                animation: slideInDown 0.5s ease;
            }

            @keyframes slideInDown {
                from {
                    opacity: 0;
                    transform: translate3d(0, -100%, 0);
                }
                to {
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                }
            }

            .stat-card {
                background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255,255,255,0.2);
                transition: all 0.3s ease;
            }

            .stat-card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            }

            .floating-icon {
                position: absolute;
                right: 1.5rem;
                top: 50%;
                transform: translateY(-50%);
                font-size: 2.5rem;
                opacity: 0.8;
                animation: float 3s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% { transform: translateY(-50%) rotate(0deg); }
                50% { transform: translateY(-60%) rotate(10deg); }
            }

            .pulse-animation {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }

            .loading-spinner {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 9999;
                background: rgba(0,0,0,0.8);
                color: white;
                padding: 2rem;
                border-radius: 15px;
                text-align: center;
            }

            .quick-action-btn {
                border-radius: 15px;
                padding: 1.5rem;
                font-size: 1rem;
                font-weight: 600;
                transition: all 0.3s ease;
                border: 2px solid transparent;
                position: relative;
                overflow: hidden;
            }

            .quick-action-btn::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
                transition: left 0.6s;
            }

            .quick-action-btn:hover::before {
                left: 100%;
            }

            .navbar-brand {
                font-weight: 700;
                font-size: 1.5rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .navbar-brand i {
                animation: pulse 2s infinite;
            }

            /* Smooth page transitions */
            .page-content {
                animation: fadeInUp 0.6s ease;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translate3d(0, 40px, 0);
                }
                to {
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                }
            }

            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb {
                background: var(--gradient-primary);
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: var(--primary-color);
            }
        </style>        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
