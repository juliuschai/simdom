@auth
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Aplikasi Sistem Domain') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.default.css') }}" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/icons/font-awesome.css') }}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>

<body>
    <div id="app" class="mainwrapper fullwrapper">
        <!--NAVIGASI MENU UTAMA-->
        <div class="leftpanel">

            <div class="logopanel">
                <h4><a href="{{route('home')}}"><?php echo "Sistem Informasi Domain ITS"; ?></a></h4>
            </div>

            <div class="datewidget">Hari ini: <?php echo date("d M Y"); ?></div>

            <div class="leftmenu">
                <ul class="nav nav-tabs nav-stacked">
                    <li class="active"><a href="{{route('home')}}"><span class="icon-align-justify"></span> Dashboard</a>
                    </li>
                    <!--MENU ADMIN-->
                    <li class="dropdown"><a href="#"><span class="icon-file"></span>Form Baru</a>
                        <ul>
                            <li><a href="{{ route('domain.baru') }}">Form Domain Baru</a></li>
                            <li><a href="{{ route('server.baru') }}">Form Server Baru</a></li>
                            @admin
                            <li><a href="{{ route('redirect.baru') }}">Form Redirect Baru</a></li>
                            @endadmin
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span class="icon-pencil"></span>List</a>
                        <ul>
                            <li><a href="{{route('domain.list')}}">Lihat List Domain</a></li>
                            <li><a href="{{route('permintaan.list')}}">Lihat List Permintaan</a></li>
                            <li><a href="{{route('server.list')}}">Lihat List Server</a></li>
                            @admin
                            <li><a href="{{route('redirect.list')}}">Lihat List Redirect</a></li>
                            @endadmin
                        </ul>
                    </li>
                    @admin
                    <li class="dropdown"><a href="#"><span class="icon-inbox"></span>Report</a>
                        <ul>
                            <li><a href="?cat=administrator&page=report">Domain Data Report</a></li>
                            <li><a href="?cat=administrator&page=report">Domain Server Report</a></li>
                            <li><a href="?cat=administrator&page=report">Domain Redirect Report</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span class="icon-signal"></span>Grafik</a>
                        <ul>
                            <li><a href="?cat=administrator&page=grafik">Lihat Grafik Domain</a></li>
                            <li><a href="?cat=administrator&page=grafik">Lihat Grafik Server</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a href="#"><span class="icon-user"></span>Admin List</a>
                        <ul>
                            <li><a href="{{route('user.list')}}">List User</a></li>
                            <li><a href="{{route('unit.list')}}">List Fakultas/Departemen/Unit</a></li>
                        </ul>
                    </li>
                    @endadmin
                </ul>
            </div>
        </div>

        <div class="rightpanel">

            <div class="headerpanel">
                <a href="" class="showmenu"></a>
                <div class="headerright">
                    <span style="color:#FFF">
                        {{ __('Selamat Datang Kembali') }} {{ auth()->user()->nama }}
                    </span>
                    <div class="dropdown userinfo"> <a class="dropdown-toggle" data-toggle="dropdown" data-target="#"
                            href="/page.html">Profil Info</a>
                        <ul class="dropdown-menu">
                            <li><a href="dashboard.php?cat=web&page=chgpwd"><span class="icon-wrench"></span> Ubah
                                    Password</a></li>
                            <li class="divider"></li>
                            <li><a href="{{route('logout')}}" onclick="
                                event.preventDefault(); 
                                document.getElementById('logout-form').submit();
                                "><span class="icon-off"></span>Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="breadcrumbwidget">
                <ul class="breadcrumb">
                    <li></li>
                </ul>
            </div>

            <div class="pagetitle">
                <h1><?php echo "Aplikasi Domain Berbasis Web"; ?></h1>
            </div>

            <div class="maincontent">
                <div class="contentinner content-dashboard">
                    <div class="row-fluid">
                        <main>
                            @yield('content')
                        </main>
                    </div>
                </div>
            </div>

        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

    </div>

    @yield('scripts')
    <script src="{{ asset('js/assets/prettify.js') }}" defer></script>
    <script src="{{ asset('js/assets/jquery-1.10.1.min.js') }}" defer></script>
    <script src="{{ asset('js/assets/jquery.alerts.js') }}" defer></script>
    <script src="{{ asset('js/assets/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/assets/custom.js') }}" defer></script>
    <script src="{{ asset('js/assets/jquery.flot.min.js') }}" defer></script>
    <script src="{{ asset('js/assets/jquery.flot.resize.min.js') }}" defer></script>
    <script src="{{ asset('js/assets/jquery.js') }}" defer></script>
</body>

</html>
@else
<script type="text/javascript">
    window.location = "{{ route('login') }}";
</script>
@endauth