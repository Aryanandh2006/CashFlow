<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - CashFlow' : 'CashFlow' }}</title>
    <link rel="shortcut icon" href="{{ Vite::asset('/public/favicon.ico') }}" type="image/x-icon">
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="module" src="https://unpkg.com/cally"></script>
</head>


<body>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle inline" />
        <div class="drawer-content">
            <!-- Navbar -->
            <nav class="navbar w-full bg-base-200">
                <label for="my-drawer-4" aria-label="open sidebar"
                    class="btn btn-square btn-ghost drawer-button flex-none">
                    <!-- Sidebar toggle icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linejoin="round"
                        stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor"
                        class="my-1.5 inline-block size-4">
                        <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                        </path>
                        <path d="M9 4v16"></path>
                        <path d="M14 10l2 2l-2 2"></path>
                    </svg>
                </label>
                <div class="px-4 flex-1">{{ isset($title) ? $title : 'Dashboard' }}</div>
                <div class="flex grow justify-end">
                    <div class="flex items-stretch">
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
                        <div class="dropdown dropdown-end">
                            <div tabindex="0" role="button" class="btn btn-ghost rounded-field">
                                <img src="{{ 'https://avatars.laravel.cloud/' . urlencode(auth()->user()->email) }}"
                                    alt="Avatar" class="w-6 h-6 rounded-full object-cover border">
                                {{ Auth()->user()->name }}
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                            <ul tabindex="-1"
                                class="menu dropdown-content bg-base-200 rounded-box z-1 mt-4 w-52 p-2 shadow-sm">
                                <li><a href="/settings"><i class="fa-solid fa-gear"></i> User Settings</a></li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <li><button><i class="fa-solid fa-right-from-bracket"></i> Logout</button></li>
                                </form>

                            </ul>
                        </div>
                    </div>

                </div>
            </nav>
            <main class="p-4">
                <!-- Success Toast -->
                @if (session('success'))
                    <div class="toast toast-top toast-center">
                        <div class="alert alert-success animate-fade-out">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>

        <div class="drawer-side is-drawer-close:overflow-visible">
            <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
            <div class="flex min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64">
                <!-- Sidebar content here -->
                <ul class="menu w-full grow">
                    <li>
                        <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right hover:none"
                            data-tip="CashFlow">
                            <img class="h-7 w-full" src="{{ Vite::asset('resources/assets/cashflowicon.svg') }}"
                                alt="Logo">
                            <span class="is-drawer-close:hidden">CashFlow</span>
                        </button>

                    </li>
                    <div style="margin: 10px 0;">
                        <hr>
                    </div>
                    <li>
                        <button onclick="location.href='/dashboard'"
                            class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Homepage">
                            <i class="fa-solid fa-home my-1.5 inline-block size-4"></i>
                            <span class="is-drawer-close:hidden">Dashboard</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="location.href='/transactions'"
                            class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Transactions">
                            <i class="fa-solid fa-up-down my-1.5 inline-block size-4"></i>
                            <span class="is-drawer-close:hidden">Transaction</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="location.href='/categories'"
                            class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Categories">
                            <i class="fa-solid fa-table-list my-1.5 inline-block size-4"></i>
                            <span class="is-drawer-close:hidden">Categories</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="location.href='/transactions/create/'"
                            class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Add Transaction">
                            <i class="fa-solid fa-circle-plus my-1.5 inline-block size-4"></i>
                            <span class="is-drawer-close:hidden">Add Transaction</span>
                        </button>
                    </li>
                    <li>
                        <button onclick="location.href='/categories/create/'"
                            class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Add Category">
                            <i class="fa-solid fa-file-circle-plus my-1.5 inline-block size-4"></i>
                            <span class="is-drawer-close:hidden">Add Category</span>
                        </button>
                    </li>
                </ul>
                <ul class="menu w-full">
                    <li>
                        <button onclick="location.href='/settings'"
                            class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Settings">
                            <i class="fa-solid fa-gear my-1.5 inline-block size-4"></i>
                            <span class="is-drawer-close:hidden">Settings</span>
                        </button>
                    </li>
                    <li>
                        <form action="/logout" method="POST">
                            @csrf
                            <button type="submit" style="cursor: pointer;"
                                class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Logout">
                                <i class="fa-solid fa-right-from-bracket my-1.5 inline-block size-4"></i>
                                <span class="is-drawer-close:hidden">Logout</span>
                            </button>
                        </form>

                    </li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>