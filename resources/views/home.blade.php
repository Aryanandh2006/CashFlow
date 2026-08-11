<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CashFlow</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (localStorage.getItem('theme') === 'dark' ||
            (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
        }
    </script>
    <script>
        // 1. Function to update the logo image source based on the current theme
        function updateLogoSource() {
            const logoEl = document.getElementById('app-logo');
            if (!logoEl) return; // Prevent errors if the logo isn't rendered on this page

            if (localStorage.getItem('theme') === 'dark') {
                logoEl.src = logoEl.getAttribute('data-dark');
            } else {
                logoEl.src = logoEl.getAttribute('data-light');
            }
        }

        syncLogoWithTheme();

        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                if (mutation.attributeName === 'data-theme') {
                    syncLogoWithTheme(); // Runs instantly when theme toggles
                }
            });
        });

        observer.observe(document.documentElement, { attributes: true });

    </script>


</head>

<body>
    <div class="drawer">
        <input id="mobile-drawer" type="checkbox" class="drawer-toggle" />

        <!-- Navbar Content Area -->
        <div class="drawer-content flex flex-col">

            <!-- MAIN NAVBAR -->
            <div class="navbar bg-base-300 w-full shadow-sm px-4">

                <!-- NAVBAR START: Hamburger (Mobile) / Navigation Links (Desktop) -->
                <div class="navbar-start">
                    <!-- Mobile Menu Trigger (Hidden on Desktop) -->
                    <div class="lg:hidden">
                        <label for="mobile-drawer" aria-label="open sidebar" class="btn btn-square btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </label>
                    </div>

                    <!-- Desktop Navigation Links (Hidden on Mobile) -->
                    <div class="hidden lg:block">
                        <ul class="menu menu-horizontal px-1 gap-2">
                            <li><a href="#home" class="active">Home</a></li>
                            <li><a href="#features">Features</a></li>
                            <li><a href="#steps">How it Works</a></li>
                        </ul>
                    </div>
                </div>

                <!-- NAVBAR CENTER: Brand Logo (Always Centered) -->
                <div class="navbar-center font-bold text-xl text-primary">
                    <a href="/" class="btn btn-ghost text-xl">
                        <img class="h-9 w-auto" src="{{ asset('assets/cashflowicon.svg') }}" alt="Cashflow Logo">
                        <span>CASHFLOW</span>
                    </a>
                </div>

                <!-- NAVBAR END: Auth Buttons (Desktop Only) + Theme Controller (Always Visible) -->
                <div class="navbar-end gap-4">
                    <!-- Desktop Auth Actions (Hidden on Mobile) -->
                    <div class="hidden lg:flex items-center gap-2">
                        <a href="/login" class="btn btn-neutral btn-sm">Login</a>
                        <a href="/register" class="btn btn-primary btn-sm">Sign Up</a>
                    </div>

                    <!-- Theme Switcher Swap Trigger (Stays on Navbar Always) -->
                    <label class="swap swap-rotate btn btn-ghost btn-circle btn-sm md:btn-md">
                        <input type="checkbox" id="theme-toggle" />
                        <!-- Sun Icon (Shows during Light Theme) -->
                        <svg class="swap-on fill-current w-5 h-5 md:w-6 md:h-6" xmlns="http://w3.org"
                            viewBox="0 0 24 24">
                            <path
                                d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41l-.71.71a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2ZM12,18a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V19A1,1,0,0,0,12,18ZM17.66,16.66a1,1,0,0,0-1.41,0l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,17.66,16.66ZM12,6a6,6,0,1,0,6,6A6,6,0,0,0,12,6Z" />
                        </svg>
                        <!-- Moon Icon (Shows during Dark Theme) -->
                        <svg class="swap-off fill-current w-5 h-5 md:w-6 md:h-6" xmlns="http://w3.org"
                            viewBox="0 0 24 24">
                            <path
                                d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
                        </svg>
                    </label>
                </div>
            </div>

            <!-- Main Page Content Slot -->
            <main class="flex-grow">
                <section id="home">
                    <div class="hero bg-base-200 min-h-screen items-start pt-[10vh]">
                        <div class="hero-content text-center flex-col gap-12 w-full max-w-6xl px-8">
                            <div class="max-w-md">
                                <h1 class="text-5xl font-bold">Take Control of your Money</h1>
                                <p class="py-6">
                                    Track your income and expenses effortlessly. Get clear insights and stay on top of
                                    your finances — all in one simple place.
                                </p>
                                <button class="btn btn-primary">Get Started</button>


                            </div>
                            <div class="mockup-browser bg-base-100 w-full border border-base-300 shadow-2xl text-left">
                                <div class="mockup-browser-toolbar">
                                    <div class="input">https://cashflow.onrender.com</div>
                                </div>
                                <div class="grid place-content-center  bg-base-200">
                                    <img src="{{ asset('assets/app.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
                <section id="features">
                    <div class="flex justify-center mt-9">
                        <div class="badge badge-neutral font-light mb-3 tracking-wide text-white">Features</div>
                    </div>

                    <div class="p-6">
                        <h1 class="text-4xl font-bold text-center">Everything you need to manage your money</h1>
                    </div>
                    <!-- Responsive wrapper grid: 1 column on mobile, 2 on tablet, 3 on laptop, 4 on desktop -->
                    <div class="flex justify-center">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 w-full max-w-5xl">

                            <!-- Card 1 (Removed w-96 so it scales dynamically) -->
                            <div class="card bg-base-200">
                                <div class="card-body">
                                    <h2 class="card-title">Track Income & Expenses</h2>
                                    <p>Easily record every transaction and keep a clear overview of where your money
                                        goes.</p>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="card bg-base-200">
                                <div class="card-body">
                                    <h2 class="card-title">Smart Categories</h2>
                                    <p>Organize your transactions with custom categories for better understanding of
                                        your spending habits.</p>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="card bg-base-200">
                                <div class="card-body">
                                    <h2 class="card-title">Clear Dashboard</h2>
                                    <p>See your total balance, monthly income, and expenses at a glance with a clean and
                                        simple dashboard.</p>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="card bg-base-200">
                                <div class="card-body">
                                    <h2 class="card-title">Private & Secure</h2>
                                    <p>Your financial data stays private. Only you can access your transactions and
                                        reports.</p>
                                </div>
                            </div>

                        </div>
                    </div>


                </section>
                <section id="steps" class="space-y-8 max-w-2xl mx-auto px-4">
                    <div class="flex justify-center mt-9">
                        <div class="badge badge-neutral font-light mb-3 tracking-wide text-white">How It Works</div>
                    </div>
                    <h2 class="text-2xl font-bold text-center">Your Journey in 3 Simple Steps</h2>

                    <div class="bg-base-100 p-6 sm:p-10 space-y-8 relative">

                        <!-- Step 1 -->
                        <div
                            class="relative pl-8 sm:pl-10 before:absolute before:left-[11px] before:top-6 before:bottom-[-36px] before:w-[2px] before:bg-primary">
                            <!-- Indicator Bullet -->
                            <div class="absolute left-0 top-1 z-10">
                                <span
                                    class="badge badge-primary badge-md p-3 font-bold w-6 h-6 flex items-center justify-center rounded-full text-primary-content">1</span>
                            </div>
                            <!-- Content Card -->
                            <div class="card bg-primary p-5 shadow-sm rounded-xl">
                                <span class="font-mono text-xs opacity-50 block mb-1 text-primary-content">STEP
                                    01</span>
                                <h3 class="font-bold text-lg text-primary-content">Create Your Account</h3>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div
                            class="relative pl-8 sm:pl-10 before:absolute before:left-[11px] before:top-6 before:bottom-[-36px] before:w-[2px] before:bg-primary">
                            <!-- Indicator Bullet -->
                            <div class="absolute left-0 top-1 z-10">
                                <span
                                    class="badge badge-primary badge-md p-3 font-bold w-6 h-6 flex items-center justify-center rounded-full text-primary-content">2</span>
                            </div>
                            <!-- Content Card -->
                            <div class="card bg-primary p-5 shadow-sm rounded-xl">
                                <span class="font-mono text-xs opacity-50 block mb-1 text-primary-content">STEP
                                    02</span>
                                <h3 class="font-bold text-lg text-primary-content">Add your Income and Expenses</h3>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="relative pl-8 sm:pl-10">
                            <!-- Indicator Bullet (No trailing line since it's the last step) -->
                            <div class="absolute left-0 top-1 z-10">
                                <span
                                    class="badge badge-primary badge-md p-3 font-bold w-6 h-6 flex items-center justify-center rounded-full text-primary-content">3</span>
                            </div>
                            <!-- Content Card -->
                            <div class="card bg-primary p-5 shadow-sm rounded-xl">
                                <span class="font-mono text-xs opacity-50 block mb-1 text-primary-content">STEP
                                    03</span>
                                <h3 class="font-bold text-lg text-primary-content">Get clear insights on your money</h3>
                            </div>
                        </div>

                    </div>
                </section>
                <section>
                    <div class="flex justify-center w-full">
                        <div class="card w-full max-w-5xl mx-auto bg-neutral text-white shadow-2xl rounded-2xl">
                            <div class="card-body items-center text-center p-8 md:p-12">
                                <h2 class="card-title text-2xl md:text-3xl font-extrabold mb-2 tracking-tight">
                                    Ready to take control of your finances?
                                </h2>
                                <div class="card-actions">
                                    <button class="btn btn-primary">Get Started</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <footer class="footer sm:footer-horizontal bg-base-200 p-10 mt-10">
                <aside>
                    <img class="h-full w-14" src="{{ asset('assets/cashflowicon.svg') }}" alt="">
                    <p>
                        CashFlow
                    </p>
                </aside>
                <nav>
                    <h6 class="footer-title">In Page</h6>
                    <div class="grid grid-flow-row gap-4">
                        <a href="#home">Home</a>
                        <a href="#features">Features</a>
                        <a href="#steps">How it works</a>
                    </div>
                </nav>
                <nav>
                    <h6 class="footer-title">Quick Links</h6>
                    <div class="grid grid-flow-row gap-4">
                        <a href="/login">Login</a>
                        <a href="/register">Sign Up</a>
                    </div>
                </nav>
            </footer>

        </div>

        <!-- SIDEBAR DRAWER (Mobile Navigation Interface) -->
        <div class="drawer-side z-50">
            <label for="mobile-drawer" aria-label="close sidebar" class="drawer-overlay"></label>

            <div class="menu bg-base-200 min-h-full w-80 p-4 text-base-content flex flex-col justify-between">
                <!-- Top Segment: Navigation Links -->
                <div class="w-full flex flex-col gap-2">
                    <span class="font-bold text-lg px-4 py-2 border-b border-base-300 mb-2 block">Menu</span>
                    <ul class="flex flex-col gap-2">
                        <li><a href="#home" class="active">Home</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#steps">How it Works</a></li>
                    </ul>
                </div>

                <!-- Bottom Segment: Auth Call to Actions moved into Mobile Viewport -->
                <div class="w-full flex flex-col gap-2 pt-4 border-t border-base-300">
                    <a href="/login" class="btn btn-outline btn-block">Login</a>
                    <a href="/register" class="btn btn-primary btn-block">Sign Up</a>
                </div>
            </div>
        </div>
    </div>


</body>

</html>