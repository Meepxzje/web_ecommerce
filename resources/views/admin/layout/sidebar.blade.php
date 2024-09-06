<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">VinnMeep - Dashboard<sup>2</sup></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang chủ Admin</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang chủ</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Data" aria-expanded="true" aria-controls="Data">
            <i class="fas fa-fw fa-cog"></i>
            <span>Data</span>
        </a>
        <div id="Data" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"> <i class="fas fa-fw fa-home"></i> Data</h6>
                <a class="collapse-item" href="/admin/ncc">Nhà Cung Cấp</a>
                <a class="collapse-item" href="/admin/nsx">Nhà Sản Xuất</a>
                <a class="collapse-item" href="/admin/dm">Danh Mục</a>
                <a class="collapse-item" href="/admin/sp">Sản Phẩm</a>
                <a class="collapse-item" href="/admin/pttt">Phương thức thanh toán</a>
                <!-- <a class="collapse-item" href="/admin/pvc">Phí vận chuyển</a> -->

                <a class="collapse-item" href="/admin/taikhoantrongweb">Tài khoản</a>
                <a class="collapse-item" href="/admin/magiamgia">Mã giảm giá</a>

                <a class="collapse-item collapsed" href="#" data-toggle="collapse" data-target="#SubThongSo" aria-expanded="false" aria-controls="SubThongSo">Thông Số</a>
                <div id="SubThongSo" class="collapse" aria-labelledby="headingTwo" data-parent="#Data">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Thông Số</h6>
                        <a class="collapse-item" href="/admin/cpu">CPU</a>
                        <a class="collapse-item" href="/admin/gpu">VGA</a>
                        <a class="collapse-item" href="/admin/ram">Ram</a>
                        <a class="collapse-item" href="/admin/manhinh">Size Màn hình</a>
                        <a class="collapse-item" href="/admin/ssd">SSD</a>
                        <a class="collapse-item" href="/admin/dophangiai">Độ phân giải</a>
                        <a class="collapse-item" href="/admin/tamnen">Tấm nền</a>
                        <a class="collapse-item" href="/admin/tansoquet">Tần số quét</a>
                        <a class="collapse-item" href="/admin/loairam">Loại ram</a>
                        <a class="collapse-item" href="/admin/busram">Bus ram</a>
                        <a class="collapse-item" href="/admin/loaibanphim">Loại bàn phím</a>
                        <a class="collapse-item" href="/admin/kieudangbanphim">Kiểu dáng bàn phím</a>
                        <a class="collapse-item" href="/admin/keycap">Keycap</a>
                        <a class="collapse-item" href="/admin/kieutainghe">Kiểu tai nghe</a>
                        <a class="collapse-item" href="/admin/congketnoi">Cổng kết nối</a>
                    </div>
                </div>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Theo dỗi đơn hàng
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Quản lý</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Quản lý</h6>
                <a class="collapse-item" href="{{route('admin.donhang')}}">Đơn hàng</a>
            </div>
        </div>
    </li>



    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
