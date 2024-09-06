<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="{{asset('/back-end/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('back-end/css/sb-admin-2.min.css')}}">
    <link href="{{asset('back-end/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body id="page-top">
    <div id="wrapper">
        <aside>
            @include('admin.layout.sidebar')
        </aside>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <aside>
                    @include('admin.layout.topbar')
                </aside>
                <main>
                    @yield('home')
                    @yield('sp(index)')
                    @yield('ncc(index)')
                    @yield('ncc(edit)')
                    @yield('nsx(index)')
                    @yield('nsx(edit)')
                    @yield('dm(index)')
                    @yield('dm(edit)')
                    @yield('sp(add)')
                    @yield('sp(edit)')
                    @yield('sp(thongso)')
                    @yield('pttt')
                    @yield('pvc')
                    @yield('qldonhang')
                    @yield('cpu')
                    @yield('gpu')
                    @yield('ram')
                    @yield('ssd')
                    @yield('manhinh')
                    @yield('dophangiai')
                    @yield('tamnen')
                    @yield('tansoquet')
                    @yield('loairam')
                    @yield('busram')
                    @yield('loaibanphim')
                    @yield('kieudangbanphim')
                    @yield('keycap')
                    @yield('kieutainghe')
                    @yield('congketnoi')
                    @yield('magiamgia')
                    @yield('chitietmagiamgia')
                    @yield('spdanggiam')
                    @yield('qltaikhoan')
                </main>
            </div>
            <aside>
                @include('admin.layout.footer')
            </aside>
        </div>
    </div>
    @include('admin.layout.thongbao')

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="{{asset('back-end/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('back-end/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('back-end/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('back-end/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('back-end/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('back-end/js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{asset('back-end/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('back-end/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('back-end/js/demo/datatables-demo.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-trendline"></script>

    @yield('js(indexsp)')
    @yield('js(indexpttt)')
    @yield('js(indexcpu)')
    @yield('js(indexgpu)')
    @yield('js(indexram)')
    @yield('js(indexssd)')
    @yield('js(indexmanhinh)')
    @yield('js(indexdophangiai)')
    @yield('js(indextamnen)')
    @yield('js(indextansoquet)')
    @yield('js(indexloairam)')
    @yield('js(indexbusram)')
    @yield('js(indexloaibanphim)')
    @yield('js(indexkieudangbanphim)')
    @yield('js(indexkeycap)')
    @yield('js(indexkieutainghe)')
    @yield('js(indexcongketnoi)')
    @yield('js(indexmagiamgia)')
    @yield('js(indexchitietmagiamgia)')
    @yield('js(donhang)')
    @yield('js.admin.home')


</body>

</html>
