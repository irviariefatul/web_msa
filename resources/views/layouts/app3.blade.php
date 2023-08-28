<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MSA</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/typicons.font/font/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.png') }}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Search-->
    <link href="{{ asset('dashboard/css/vertical-layout-light/select2.min.css') }}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Scripts Tabel -->
    <link href="{{ asset('quixlab/./plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('quixlab/css/style.css') }}" rel="stylesheet">

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class=" text-center navbar-brand brand-logo" href="{{ route('home') }}"><img
                        src="{{ asset('Images/sig-msa-panjang.png') }}" alt="logo" /></a>
                <a class=" text-center navbar-brand brand-logo-mini" href="{{ route('home') }}"><img
                        src="{{ asset('Images/ikon-circle.png') }}" alt="logo" /></a>
                <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button"
                    data-toggle="minimize">
                    <span class="typcn typcn-th-menu-outline text-gray"></span>
                </button>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav navbar-nav-right">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item nav-profile dropdown">
                                <a class="nav-link dropdown-toggle pl-0 pr-0" href="{{ route('login') }}">
                                    <i class="typcn typcn-login-outline text-white">
                                        <span class="nav-profile-name">{{ __('Login') }} </span>
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle pl-0 pr-0" href="#" data-toggle="dropdown"
                                id="profileDropdown" aria-expanded="false">
                                <i class="typcn typcn-user-outline text-white"></i>
                                <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/profil">
                                    <i class="typcn typcn-user-outline text-gray"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="typcn typcn-power-outline text-gray"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <script>
                            const dropdownToggle = document.querySelector('.nav-link.dropdown-toggle');
                            const dropdownMenu = document.querySelector('.dropdown-menu');

                            dropdownToggle.addEventListener('click', function() {
                                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                                this.setAttribute('aria-expanded', !isExpanded);

                                if (!isExpanded) {
                                    dropdownMenu.classList.add('show');
                                } else {
                                    dropdownMenu.classList.remove('show');
                                }
                            });
                        </script>
                    @endguest
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="typcn typcn-th-menu-outline"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_settings-panel.html -->
            <!-- partial -->
            <!-- partial:../../partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <p class="sidebar-menu-title">Dash menu</p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Dashboard</span></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        @can('manage-admins')
                            <a class="nav-link" href="http://127.0.0.1:8000/users">
                                <i class="typcn typcn-user-add-outline menu-icon"></i>
                                <span class="menu-title">Users</span></span>
                            </a>
                        @endcan
                    </li>
                    @can('manage-admins')
                        <li class="nav-item">
                            <a class="nav-link" href="http://127.0.0.1:8000/permintaans">
                                <i class="typcn typcn-attachment-outline menu-icon"></i>
                                <span class="menu-title">Incoming Requests</span></span>
                            </a>
                        </li>
                    @endcan
                    @can('manage-users')
                        <li class="nav-item">
                            <a class="nav-link" href="http://127.0.0.1:8000/permintaans">
                                <i class="typcn typcn-attachment-outline menu-icon"></i>
                                <span class="menu-title">Requests</span></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                                aria-controls="ui-basic">
                                <i class="typcn typcn-briefcase menu-icon"></i>
                                <span class="menu-title">Human Resources</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="http://127.0.0.1:8000/perhitungan_gajis">Salary Calculations</a></li>
                                </ul>
                            </div>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="http://127.0.0.1:8000/qualifications">Qualifications</a></li>
                                </ul>
                            </div>
                        @endcan
                        @can('manage-admins')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                                aria-controls="ui-basic">
                                <i class="typcn typcn-briefcase menu-icon"></i>
                                <span class="menu-title">Positions</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="http://127.0.0.1:8000/perhitungan_gajis">Salary Calculations</a></li>
                                </ul>
                            </div>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="http://127.0.0.1:8000/qualifications">Qualifications</a></li>
                                </ul>
                            </div>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="http://127.0.0.1:8000/salaries">Salaries</a></li>
                                </ul>
                            </div>
                            <div class="collapse" id="ui-basic">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="http://127.0.0.1:8000/allowances">Allowances</a></li>
                                </ul>
                            </div>
                        </li>
                    @endcan
                    @can('manage-admins')
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false"
                                aria-controls="Positions">
                                <i class="typcn typcn-spanner-outline menu-icon"></i>
                                <span class="menu-title">Components</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="charts">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="http://127.0.0.1:8000/investments">Investment Components</a></li>
                                </ul>
                            </div>
                            <div class="collapse" id="charts">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item"> <a class="nav-link"
                                            href="http://127.0.0.1:8000/operasionals">Operational Components</a></li>
                                </ul>
                            </div>
                        </li>
                    @endcan
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        @yield('content')
                        <!-- content-wrapper ends -->
                        <!-- partial:../../partials/_footer.html -->
                        <footer class="footers">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                                <span class="text-center text-sm-left d-block d-sm-inline-block">Developed by Alfina
                                    Nur Azizah, IchsanI Nikken Rahamawat and Irvi Ariefatul Julia Putri
                                    2023</span>
                            </div>
                        </footer>
                        <!-- partial -->
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="{{ asset('dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('dashboard/js/off-canvas.js') }}"></script>
    <script src="{{ asset('dashboard/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('dashboard/js/template.js') }}"></script>
    <script src="{{ asset('dashboard/js/settings.js') }}"></script>
    <script src="{{ asset('dashboard/js/todolist.js') }}"></script>
    <!-- endinject -->

    <!-- Scripts Search Dropdown -->
    <script src="{{ asset('dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- Other scripts ... -->

    <!-- Select2 script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#Salary').select2({
                placeholder: "Search...",
                width: "100%", // Atur lebar dropdown sesuai kebutuhan Anda
                allowClear: true // Aktifkan ini jika Anda ingin memungkinkan penghapusan pilihan
            });
            $('#Qualification').select2({
                placeholder: "Search...",
                width: "100%", // Atur lebar dropdown sesuai kebutuhan Anda
                allowClear: true // Aktifkan ini jika Anda ingin memungkinkan penghapusan pilihan
            });
        });
    </script>

    <!-- Tabel -->
    <script src="{{ asset('quixlab/./plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('quixlab/./plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('quixlab/./plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
</body>

</html>
