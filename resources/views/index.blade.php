```blade
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>LosFound Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tabler Icons --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    {{-- Custom Template CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- Vite --}}
    @vite(['resources/scss/style.scss', 'resources/js/app.js'])

  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <script>
        window.lostItemsData = {
            labels: {!! $chartLabels->toJson() !!},
            series: {!! $chartData->toJson() !!}
        };
    </script>
</head>

<body>

    <div id="overlay" class="overlay"></div>

    {{-- TOPBAR --}}
    <nav id="topbar" class="navbar bg-white border-bottom fixed-top topbar px-3">

        <button id="toggleBtn" class="d-none d-lg-inline-flex btn btn-light btn-icon btn-sm">
            <i class="ti ti-layout-sidebar-left-expand"></i>
        </button>

        <div class="ms-auto">
            <ul class="list-unstyled d-flex align-items-center mb-0 gap-3">

                {{-- Notification --}}
                <li class="dropdown">
                    <a class="position-relative btn-icon btn-sm btn-light btn rounded-circle"
                        data-bs-toggle="dropdown" href="#" role="button">

                        <i class="ti ti-bell"></i>

                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            2
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-0">

                        <ul class="list-unstyled p-0 m-0">

                            <li class="p-3 border-bottom">
                                <div class="d-flex gap-3">
                                    <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                        class="avatar avatar-sm rounded-circle">

                                    <div class="flex-grow-1 small">
                                        <p class="mb-0">New order received</p>
                                        <p class="mb-1">Order #12345 has been placed</p>
                                        <div class="text-secondary">5 minutes ago</div>
                                    </div>
                                </div>
                            </li>

                        </ul>

                    </div>
                </li>

                {{-- User Dropdown --}}
                <li class="dropdown">

                    <a href="#" role="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                            class="avatar avatar-sm rounded-circle">
                    </a>

                    <div class="dropdown-menu dropdown-menu-end p-0" style="min-width: 200px;">

                        <div class="d-flex gap-3 align-items-center border-bottom px-3 py-3">

                            <img src="{{ asset('assets/images/avatar/avatar-1.jpg') }}"
                                class="avatar avatar-sm rounded-circle">

                            <div>
                                <h4 class="mb-0 small">Shrina Tesla</h4>
                                <p class="mb-0 small text-muted">@imshrina</p>
                            </div>

                        </div>

                        <div class="p-3 d-flex flex-column gap-2 small">

                            <a href="#!" class="text-decoration-none">Home</a>
                            <a href="#!" class="text-decoration-none">Inbox</a>
                            <a href="#!" class="text-decoration-none">Chat</a>
                            <a href="#!" class="text-decoration-none">Activity</a>
                            <a href="#!" class="text-decoration-none">Account Settings</a>

                        </div>

                    </div>

                </li>

            </ul>
        </div>

    </nav>

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="sidebar">

        <div class="logo-area">

            <a href="{{ url('/') }}" class="d-inline-flex align-items-center text-decoration-none">

                <span class="logo-text ms-2 fw-bold fs-4">
                    <span style="color: #000000;">Los</span>
                    <span style="color: #ff8c00;">Found</span>
                </span>

            </a>

        </div>

        <ul class="nav flex-column">

            <li class="px-4 py-2">
                <small class="nav-text">Main</small>
            </li>

            <li>
                <a class="nav-link active" href="#">
                    <i class="ti ti-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="#">
                    <i class="ti ti-box-seam"></i>
                    <span class="nav-text">Lost Items</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="#">
                    <i class="ti ti-plus"></i>
                    <span class="nav-text">Found Items</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="#">
                    <i class="ti ti-receipt"></i>
                    <span class="nav-text">My Items</span>
                </a>
            </li>

            @if(auth()->user() && auth()->user()->role === 'admin')

                <li>
                    <a class="nav-link" href="">
                        <i class="ti ti-alert-circle"></i>
                        <span class="nav-text">User Management</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="">
                        <i class="ti ti-file-text"></i>
                        <span class="nav-text">Post Management</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link" href="">
                        <i class="ti ti-plus"></i>
                        <span class="nav-text">Requests</span>
                    </a>
                </li>

            @endif

            <li class="px-4 pt-4 pb-2">
                <small class="nav-text">Account</small>
            </li>

            <li>
                <a class="nav-link" href="#">
                    <i class="ti ti-user"></i>
                    <span class="nav-text">Profile</span>
                </a>
            </li>

            <li>
                <a class="nav-link" href="#">
                    <i class="ti ti-logout"></i>
                    <span class="nav-text">Log Out</span>
                </a>
            </li>

        </ul>

    </aside>

    {{-- MAIN CONTENT --}}
    <main id="content" class="content py-5">

        <div class="container-fluid">

            <div class="row mb-4">
                <div class="col-12">
                    <h1 class="fs-3 mb-1">Dashboard</h1>
                </div>
            </div>

            <div class="row g-3">

                {{-- CARD 1 --}}
                <div class="col-lg-3 col-12">

                    <div
                        class="card p-4 bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-3">

                        <div class="d-flex gap-3">

                            <div class="icon-shape icon-md bg-primary text-white rounded-3">
                                <i class="ti ti-report-analytics fs-4"></i>
                            </div>

                            <div>
                                <h2 class="mb-3 fs-6">Lost Items</h2>
                                <h3 class="fw-bold mb-0">$25,000</h3>
                                <p class="text-primary mb-0 small">Reports from users</p>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- CARD 2 --}}
                <div class="col-lg-3 col-12">

                    <div
                        class="card p-4 bg-success bg-opacity-10 border border-success border-opacity-25 rounded-3">

                        <div class="d-flex gap-3">

                            <div class="icon-shape icon-md bg-success text-white rounded-3">
                                <i class="ti ti-repeat fs-4"></i>
                            </div>

                            <div>
                                <h2 class="mb-3 fs-6">Found Items</h2>
                                <h3 class="fw-bold mb-0">$18,000</h3>
                                <p class="text-success mb-0 small">Currently in storage</p>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- CARD 3 --}}
                <div class="col-lg-3 col-12">

                    <div
                        class="card p-4 bg-info bg-opacity-10 border border-info border-opacity-25 rounded-3">

                        <div class="d-flex gap-3">

                            <div class="icon-shape icon-md bg-info text-white rounded-3">
                                <i class="ti ti-currency-dollar fs-4"></i>
                            </div>

                            <div>
                                <h2 class="mb-3 fs-6">Reunited Items</h2>
                                <h3 class="fw-bold mb-0">$9,000</h3>
                                <p class="text-info mb-0 small">Success stories</p>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- CARD 4 --}}
                <div class="col-lg-3 col-12">

                    <div
                        class="card p-4 bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded-3">

                        <div class="d-flex gap-3">

                            <div class="icon-shape icon-md bg-warning text-white rounded-3">
                                <i class="ti ti-notes fs-4"></i>
                            </div>

                            <div>
                                <h2 class="mb-3 fs-6">Total Users</h2>
                                <h3 class="fw-bold mb-0">$25,000</h3>
                                <p class="text-warning mb-0 small">+35% since last month</p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- ApexCharts --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</body>

</html>
```
