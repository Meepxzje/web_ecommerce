<?php

use App\Http\Controllers\Admin\ChitietmagiamgiaController;
use App\Http\Controllers\Admin\DanhgiaController;
use App\Http\Controllers\Admin\DanhmucController;
use App\Http\Controllers\Admin\DonhangController;
use App\Http\Controllers\Admin\GiohangController;
use App\Http\Controllers\Admin\MagiamgiaController;
use App\Http\Controllers\Admin\NguoidungController;
use App\Http\Controllers\Admin\NhacungcapController;
use App\Http\Controllers\Admin\NhasanxuatController;
use App\Http\Controllers\Admin\PhuongthucthanhtoanController;
use App\Http\Controllers\Admin\SanphamController;
use App\Http\Controllers\Admin\ThongsoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MomoController;
use App\Http\Controllers\Admin\VanchuyenController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\DoitraController;
use App\Http\Controllers\GHNController;
use App\Http\Controllers\GiamgiaController;
use App\Http\Controllers\Phukien\ThongsopkmanhinhController;
use App\Http\Controllers\QuatangController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\sub\BusramController;
use App\Http\Controllers\sub\CongketnoiController;
use App\Http\Controllers\sub\CpuController;
use App\Http\Controllers\sub\DophangiaiController;
use App\Http\Controllers\sub\GpuController;
use App\Http\Controllers\sub\KeycapController;
use App\Http\Controllers\sub\KieudangbanphimController;
use App\Http\Controllers\sub\KieutaingheController;
use App\Http\Controllers\sub\LoaibanphimController;
use App\Http\Controllers\sub\LoairamController;
use App\Http\Controllers\sub\ManhinhController;
use App\Http\Controllers\sub\RamController;
use App\Http\Controllers\sub\SsdController;
use App\Http\Controllers\sub\TamnenController;
use App\Http\Controllers\sub\TansoquetController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VnpayController;







Route::get('/', [HomeController::class, 'index'])->name('index');;
Route::get('/danhsachsp', [HomeController::class, 'danhsachsp'])->name('danhsachsp');
Route::get('/danhsachsp/{id}', [HomeController::class, 'danhsachdanhmuc'])->name('danhsachdanhmuc');
Route::get('/sp/chitiet/{id}', [HomeController::class, 'chitietsp'])->name('chitietsp');
Route::get('/spgiamgia', [HomeController::class, 'spgiamgia'])->name('spgiamgia');




Route::post('/filter-products', [HomeController::class, 'filterProducts'])->name('filter.products');
Route::post('/filter-productsgiamgia', [HomeController::class, 'filterProductsgiamgia'])->name('filter.productsgiamgia');
Route::post('/filter-productsdm/{id}', [HomeController::class, 'filterProductsdm'])->name('filter.productsdm');
Route::get('/timkiem', [HomeController::class, 'timkiem'])->name('timkiem');
Route::get('/autocomplete', [HomeController::class, 'autocomplete'])->name('autocomplete');


Route::middleware(['admin'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');


    Route::get('/admin/get-yearly-sales', [AdminController::class, 'getYearlySales'])->name('admin.getYearlySales');
    Route::get('/admin/sanphamdaban1', [AdminController::class, 'getSanPhamDaBan1'])->name('sanphamdaban');
    Route::get('/admin/sanphamdaban', [AdminController::class, 'getSanPhamDaBan'])->name('admin.getSanPhamDaBan');
    Route::get('/admin/donhangtheothang', [AdminController::class, 'getDonhang'])->name('donhangtheothang');


    Route::get('/export-report', [ReportController::class, 'exportReport'])->name('export.report');



    Route::get('/admin/nsx', [NhasanxuatController::class, 'index'])->name('admin.indexnsx');
    Route::post('/admin/addnsx', [NhasanxuatController::class, 'store'])->name('admin.storensx');
    Route::get('/admin/editnsx/{id}', [NhasanxuatController::class, 'edit'])->name('admin.editnsx');
    Route::put('/admin/updatensx/{id}', [NhasanxuatController::class, 'update'])->name('admin.updatensx');
    Route::get('/admin/detelensx/{id}', [NhasanxuatController::class, 'destroy'])->name('admin.deletensx');

    Route::get('/admin/ncc', [NhacungcapController::class, 'index'])->name('admin.indexncc');
    Route::post('/admin/storencc', [NhacungcapController::class, 'store'])->name('admin.storencc');
    Route::get('/admin/editncc/{id}', [NhacungcapController::class, 'edit'])->name('admin.editncc');
    Route::put('/admin/updatencc/{id}', [NhacungcapController::class, 'update'])->name('admin.updatencc');
    Route::get('/admin/detelencc/{id}', [NhacungcapController::class, 'destroy'])->name('admin.deletencc');

    Route::get('/admin/dm', [DanhmucController::class, 'index'])->name('admin.indexdm');
    Route::post('/admin/adddm', [DanhmucController::class, 'store'])->name('admin.storedm');
    Route::get('/admin/editdm/{id}', [DanhmucController::class, 'edit'])->name('admin.editdm');
    Route::put('/admin/updatedm/{id}', [DanhmucController::class, 'update'])->name('admin.updatedm');
    Route::get('/admin/deteledm/{id}', [DanhmucController::class, 'destroy'])->name('admin.deletedm');

    Route::get('/admin/sp', [SanphamController::class, 'index'])->name('admin.indexsp');
    Route::post('/admin/addsp', [SanphamController::class, 'store'])->name('admin.storesp');
    Route::put('/admin/updatesp/{id}', [SanphamController::class, 'update'])->name('admin.updatesp');
    Route::get('/admin/detelesp/{id}', [SanphamController::class, 'destroy'])->name('admin.deletesp');
    Route::get('/admin/{id}/thongso', [SanphamController::class, 'thongso'])->name('admin.thongsosp');

    Route::post('/admin/{id}/thongsohieunang', [ThongsoController::class, 'thongsohieunang'])->name('admin.thongsohieunang');
    Route::post('/admin/{id}/thongsoketnoi', [ThongsoController::class, 'thongsoketnoi'])->name('admin.thongsoketnoi');
    Route::post('/admin/{id}/thongsoluutru', [ThongsoController::class, 'thongsoluutru'])->name('admin.thongsoluutru');
    Route::post('/admin/{id}/thongsomanhinh', [ThongsoController::class, 'thongsomanhinh'])->name('admin.thongsomanhinh');
    Route::post('/admin/{id}/thongsopin', [ThongsoController::class, 'thongsopin'])->name('admin.thongsopin');
    Route::post('/admin/{id}/thongsotongquat', [ThongsoController::class, 'thongsotongquat'])->name('admin.thongsotongquat');
    Route::post('/admin/{id}/thongsotruyenthong', [ThongsoController::class, 'thongsotruyenthong'])->name('admin.thongsotruyenthong');


    Route::get('/admin/pttt', [PhuongthucthanhtoanController::class, 'index'])->name('admin.indexpttt');
    Route::post('/admin/addpttt', [PhuongthucthanhtoanController::class, 'store'])->name('admin.storepttt');
    Route::get('/admin/editpttt/{id}', [PhuongthucthanhtoanController::class, 'edit'])->name('admin.editpttt');
    Route::put('/admin/updatepttt/{id}', [PhuongthucthanhtoanController::class, 'update'])->name('admin.updatepttt');
    Route::get('/admin/detelepttt/{id}', [PhuongthucthanhtoanController::class, 'destroy'])->name('admin.deletepttt');


    Route::get('/admin/qldonhang', [AdminController::class, 'donhang'])->name('admin.donhang');
    Route::get('/admin/donhang/capnhattinhtrangdaxacnhan/{id}', [AdminController::class, 'capnhattinhtrangdaxacnhan'])->name('admin.donhang.capnhattinhtrangdaxacnhan');
    Route::get('/admin/donhang/capnhattinhtrangdanggiao/{id}', [AdminController::class, 'capnhattinhtrangdanggiao'])->name('admin.donhang.capnhattinhtrangdanggiao');
    Route::get('/admin/donhang/capnhattinhtranghoanthanh/{id}', [AdminController::class, 'capnhattinhtranghoanthanh'])->name('admin.donhang.capnhattinhtranghoanthanh');
    Route::post('/admin/donhang/huydon/{id}', [AdminController::class, 'huydon'])->name('admin.donhang.huydon');



    Route::put('/admin/suadonhang/{id}', [AdminController::class, 'updateDonhang'])->name('admin.suadonhang');




    Route::post('/getSanphams/{danhmucId}', [SanphamController::class, 'getSanphams']);
    Route::get('/getQuatang/{sanphamId}', [SanphamController::class, 'getQuatang']);
    Route::post('/admintaodon', [AdminController::class, 'admintaodon'])->name('admin.donhang.admintaodon');



    Route::get('/admin/spdanggiam', [AdminController::class, 'spdanggiam'])->name('admin.spdanggiam');
    Route::get('/admin/deletespdanggiam/{id}', [AdminController::class, 'deletespdanggiam'])->name('admin.deletespdanggiam');
    Route::put('/admin/updatespdanggiam/{id}', [AdminController::class, 'updatespdanggiam'])->name('admin.updatespdanggiam');


    Route::get('/admin/deletespdanggiamhl/{id}', [AdminController::class, 'deletespdanggiamhl'])->name('admin.deletespdanggiamhl');
    Route::put('/admin/updatespdanggiamhl/{id}', [AdminController::class, 'updatespdanggiamhl'])->name('admin.updatespdanggiamhl');


    Route::get('/admin/taikhoantrongweb', [AdminController::class, 'taikhoantrongweb'])->name('admin.taikhoantrongweb');



    Route::get('/admin/cpu', [CpuController::class, 'index'])->name('admin.indexcpu');
    Route::post('/admin/addcpu', [CpuController::class, 'store'])->name('admin.storecpu');
    Route::put('/admin/updatecpu/{id}', [CpuController::class, 'update'])->name('admin.updatecpu');
    Route::get('/admin/detelecpu/{id}', [CpuController::class, 'destroy'])->name('admin.deletecpu');

    Route::get('/admin/gpu', [GpuController::class, 'index'])->name('admin.indexgpu');
    Route::post('/admin/addgpu', [GpuController::class, 'store'])->name('admin.storegpu');
    Route::put('/admin/updategpu/{id}', [GpuController::class, 'update'])->name('admin.updategpu');
    Route::get('/admin/detelegpu/{id}', [GpuController::class, 'destroy'])->name('admin.deletegpu');


    Route::get('/admin/ram', [RamController::class, 'index'])->name('admin.indexram');
    Route::post('/admin/addram', [RamController::class, 'store'])->name('admin.storeram');
    Route::put('/admin/updateram/{id}', [RamController::class, 'update'])->name('admin.updateram');
    Route::get('/admin/deteleram/{id}', [RamController::class, 'destroy'])->name('admin.deleteram');

    Route::get('/admin/ssd', [SsdController::class, 'index'])->name('admin.indexssd');
    Route::post('/admin/addssd', [SsdController::class, 'store'])->name('admin.storessd');
    Route::put('/admin/updatessd/{id}', [SsdController::class, 'update'])->name('admin.updatessd');
    Route::get('/admin/detelessd/{id}', [SsdController::class, 'destroy'])->name('admin.deletessd');


    Route::get('/admin/manhinh', [ManhinhController::class, 'index'])->name('admin.indexmanhinh');
    Route::post('/admin/addmanhinh', [ManhinhController::class, 'store'])->name('admin.storemanhinh');
    Route::put('/admin/updatemanhinh/{id}', [ManhinhController::class, 'update'])->name('admin.updatemanhinh');
    Route::get('/admin/detelemanhinh/{id}', [ManhinhController::class, 'destroy'])->name('admin.deletemanhinh');

    Route::get('/admin/tansoquet', [TansoquetController::class, 'index'])->name('admin.indextansoquet');
    Route::post('/admin/addtansoquet', [TansoquetController::class, 'store'])->name('admin.storetansoquet');
    Route::put('/admin/updatetansoquet/{id}', [TansoquetController::class, 'update'])->name('admin.updatetansoquet');
    Route::get('/admin/deteletansoquet/{id}', [TansoquetController::class, 'destroy'])->name('admin.deletetansoquet');

    Route::get('/admin/tamnen', [TamnenController::class, 'index'])->name('admin.indextamnen');
    Route::post('/admin/addtamnen', [TamnenController::class, 'store'])->name('admin.storetamnen');
    Route::put('/admin/updatetamnen/{id}', [TamnenController::class, 'update'])->name('admin.updatetamnen');
    Route::get('/admin/deteletamnen/{id}', [TamnenController::class, 'destroy'])->name('admin.deletetamnen');

    Route::get('/admin/dophangiai', [DophangiaiController::class, 'index'])->name('admin.indexdophangiai');
    Route::post('/admin/adddophangiai', [DophangiaiController::class, 'store'])->name('admin.storedophangiai');
    Route::put('/admin/updatedophangiai/{id}', [DophangiaiController::class, 'update'])->name('admin.updatedophangiai');
    Route::get('/admin/deteledophangiai/{id}', [DophangiaiController::class, 'destroy'])->name('admin.deletedophangiai');

    Route::get('/admin/loairam', [LoairamController::class, 'index'])->name('admin.indexloairam');
    Route::post('/admin/adddloairam', [LoairamController::class, 'store'])->name('admin.storeloairam');
    Route::put('/admin/updateloairam/{id}', [LoairamController::class, 'update'])->name('admin.updateloairam');
    Route::get('/admin/deteleloairam/{id}', [LoairamController::class, 'destroy'])->name('admin.deleteloairam');

    Route::get('/admin/busram', [BusramController::class, 'index'])->name('admin.indexbusram');
    Route::post('/admin/addbusram', [BusramController::class, 'store'])->name('admin.storebusram');
    Route::put('/admin/updatebusram/{id}', [BusramController::class, 'update'])->name('admin.updatebusram');
    Route::get('/admin/detelebusram/{id}', [BusramController::class, 'destroy'])->name('admin.deletebusram');


    Route::get('/admin/loaibanphim', [LoaibanphimController::class, 'index'])->name('admin.indexloaibanphim');
    Route::post('/admin/addloaibanphim', [LoaibanphimController::class, 'store'])->name('admin.storeloaibanphim');
    Route::put('/admin/updateloaibanphim/{id}', [LoaibanphimController::class, 'update'])->name('admin.updateloaibanphim');
    Route::get('/admin/deteleloaibanphim/{id}', [LoaibanphimController::class, 'destroy'])->name('admin.deleteloaibanphim');

    Route::get('/admin/kieudangbanphim', [KieudangbanphimController::class, 'index'])->name('admin.indexkieudangbanphim');
    Route::post('/admin/addkieudangbanphim', [KieudangbanphimController::class, 'store'])->name('admin.storekieudangbanphim');
    Route::put('/admin/updatekieudangbanphim/{id}', [KieudangbanphimController::class, 'update'])->name('admin.updatekieudangbanphim');
    Route::get('/admin/detelekieudangbanphim/{id}', [KieudangbanphimController::class, 'destroy'])->name('admin.deletekieudangbanphim');

    Route::get('/admin/keycap', [KeycapController::class, 'index'])->name('admin.indexkeycap');
    Route::post('/admin/adddkeycap', [KeycapController::class, 'store'])->name('admin.storekeycap');
    Route::put('/admin/updatekeycap/{id}', [KeycapController::class, 'update'])->name('admin.updatekeycap');
    Route::get('/admin/detelekeycap/{id}', [KeycapController::class, 'destroy'])->name('admin.deletekeycap');

    Route::get('/admin/kieutainghe', [KieutaingheController::class, 'index'])->name('admin.indexkieutainghe');
    Route::post('/admin/adddkieutainghe', [KieutaingheController::class, 'store'])->name('admin.storekieutainghe');
    Route::put('/admin/updatekieutainghe/{id}', [KieutaingheController::class, 'update'])->name('admin.updatekieutainghe');
    Route::get('/admin/detelekieutainghe/{id}', [KieutaingheController::class, 'destroy'])->name('admin.deletekieutainghe');


    Route::get('/admin/congketnoi', [CongketnoiController::class, 'index'])->name('admin.indexcongketnoi');
    Route::post('/admin/addcongketnoi', [CongketnoiController::class, 'store'])->name('admin.storecongketnoi');
    Route::put('/admin/updatecongketnoi/{id}', [CongketnoiController::class, 'update'])->name('admin.updatecongketnoi');
    Route::get('/admin/detelecongketnoi/{id}', [CongketnoiController::class, 'destroy'])->name('admin.deletecongketnoi');



    Route::post('/admin/{id}/thongsopkmanhinh', [ThongsoController::class, 'thongsopkmanhinh'])->name('admin.thongsopkmanhinh');
    Route::post('/admin/{id}/thongsopksram', [ThongsoController::class, 'thongsopkram'])->name('admin.thongsopkram');
    Route::post('/admin/{id}/thongsopkbanphim', [ThongsoController::class, 'thongsopkbanphim'])->name('admin.thongsopkbanphim');
    Route::post('/admin/thongsopkchuot/{id}', [ThongsoController::class, 'thongsopkchuot'])->name('admin.thongsopkchuot');
    Route::post('/admin/thongsopktainghe/{id}', [ThongsoController::class, 'thongsopktainghe'])->name('admin.thongsopktainghe');





    Route::get('/getSanphamByDanhmuc/{danhmucId}', [SanphamController::class, 'getSanphamByDanhmuc']);
    Route::post('/addgift', [QuatangController::class, 'store'])->name('saveGift');
    Route::get('/getGifts/{id}', [QuatangController::class, 'getGifts']);
    Route::delete('/deleteGift', [QuatangController::class, 'deleteGift']);



    Route::post('/sanpham/giamgia', [GiamgiaController::class, 'addDiscount'])->name('sanpham.addDiscount');
    Route::get('/sanpham/laygiamgia/{id}', [GiamgiaController::class, 'getDiscount'])->name('sanpham.getDiscount');


    Route::post('/sanpham/giohangiamgiahangloat', [GiamgiaController::class, 'addBulkDiscount'])->name('sanpham.addBulkDiscount');



    Route::get('/get-order-details/{id}', [AdminController::class, 'getOrderDetails'])->name('getOrderDetails');



    Route::get('/xacnhandoitra/{id}', [DonhangController::class, 'xacnhandoitra'])->name('xacnhandoitra');


    Route::get('/admin/magiamgia', [MagiamgiaController::class, 'index'])->name('admin.indexmagiamgia');
    Route::post('/admin/addmagiamgia', [MagiamgiaController::class, 'store'])->name('admin.storemagiamgia');
    Route::put('/admin/updatemagiamgia/{id}', [MagiamgiaController::class, 'update'])->name('admin.updatemagiamgia');
    Route::get('/admin/detelemagiamgia/{id}', [MagiamgiaController::class, 'destroy'])->name('admin.deletemagiamgia');


    Route::get('/admin/chitietmagiamgia', [ChitietmagiamgiaController::class, 'index'])->name('admin.indexchitietmagiamgia');
    Route::post('/admin/addchitietmagiamgia', [ChitietmagiamgiaController::class, 'store'])->name('admin.storechitietmagiamgia');
    Route::put('/admin/updatechitietmagiamgia/{id}', [ChitietmagiamgiaController::class, 'update'])->name('admin.updatechitietmagiamgia');
    Route::get('/admin/detelechitietmagiamgia/{id}', [ChitietmagiamgiaController::class, 'destroy'])->name('admin.deletechitietmagiamgia');


    Route::post('/admin/addchitietmagiamgiahangloat', [ChitietmagiamgiaController::class, 'storehangloat'])->name('admin.storechitietmagiamgiahangloat');


    Route::get('/send-email', [AdminController::class, 'sendEmail'])->name('sendmail');

    Route::get('/getUserDetails/{userId}', [AdminController::class, 'getUserDetails']);
    Route::get('/getProductPrice/{productId}', [AdminController::class, 'getProductPrice']);
});


Route::get('/admin/pvc', [VanchuyenController::class, 'index'])->name('admin.indexpvc');
Route::post('/admin/pvc/addpvc', [VanchuyenController::class, 'store'])->name('admin.storepvc');
Route::get('/admin/detelepvc/{id}', [VanchuyenController::class, 'destroy'])->name('admin.deletepvc');





// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });







Route::get('/giohang', [GiohangController::class, 'index'])->name('giohang');
Route::post('/giohang/add', [GiohangController::class, 'addToCart'])->name('giohang.addToCart');
Route::post('/giohang/addctsp', [GiohangController::class, 'addToCartSP'])->name('giohang.addtocartsp');
Route::post('/giohang/sync', [GiohangController::class, 'syncSessionToDatabase'])->name('giohang.sync');
Route::get('/giohang/remove/{id}', [GiohangController::class, 'removeFromCart'])->name('giohang.remove');
Route::get('/giohang/removess/{id}', [GiohangController::class, 'removess'])->name('giohang.removess');
Route::post('/update-quantity', [GiohangController::class, 'updateQuantity'])->name('giohang.update.quantity');
Route::post('/save-discount', [GiohangController::class, 'saveDiscount'])->name('save.discount');


Route::post('/danhgia', [DanhgiaController::class, 'store'])->name('danhgia.store');
Route::delete('/danhgia/{id}', [DanhgiaController::class, 'destroy'])->name('danhgia.destroy');
Route::get('/danhgia/{id}/edit', [DanhgiaController::class, 'edit'])->name('danhgia.edit');
Route::put('/danhgia/{id}', [DanhgiaController::class, 'update'])->name('danhgia.update');


Route::get('/thanhtoan', [DonhangController::class, 'index'])->name('thanhtoan');
Route::post('/checkout', [DonhangController::class, 'store'])->name('checkout');



Route::post('/testghn', [GHNController::class, 'createShipment'])->name('testghn');
Route::post('/createghn/{id}', [GHNController::class, 'createShippingOrder'])->name('createghn');
Route::post('/capnhattrangthai', [GHNController::class, 'capnhattrangthai'])->name('capnhattrangthai');


Route::post('/momo/ipn', [MomoController::class, 'ipnHandler'])->name('momo.ipn');
Route::get('/momo/return', [MomoController::class, 'returnHandler'])->name('momo.return');
Route::post('/vnpay/ipn', [VnpayController::class, 'ipnHandler'])->name('vnpay.ipn');
Route::get('/vnpay/return', [VnpayController::class, 'returnHandler'])->name('vnpay.return');
Route::post('/vnpay/create', [VnpayController::class, 'createPayment'])->name('vnpay.create');




Route::get('dangnhap', [NguoidungController::class, 'showRegistrationForm'])->name('dangnhap');
Route::post('register', [NguoidungController::class, 'register'])->name('register');
Route::post('login', [NguoidungController::class, 'login'])->name('login');
Route::post('logout', [NguoidungController::class, 'logout'])->name('logout');
Route::get('check', [NguoidungController::class, 'check'])->name('check');
Route::post('capnhatnguoidung', [NguoidungController::class, 'capnhatnguoidung'])->name('capnhatnguoidung');


Route::get('/sosanh', [NguoidungController::class, 'sosanh'])->name('sosanh');
Route::post('/addsosanh/{id}', [NguoidungController::class, 'addToCompare'])->name('addToCompare');
Route::post('/removesosanh/{id}', [NguoidungController::class, 'removeFromCompare'])->name('removeFromCompare');
Route::post('/removeall', [NguoidungController::class, 'removeAllFromCompare'])->name('removeAllFromCompare');


Route::get('forgot-password', [NguoidungController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [NguoidungController::class, 'sendResetLink'])->name('password.email');
Route::get('reset-password/{token}', [NguoidungController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [NguoidungController::class, 'resetPassword'])->name('password.update');

Route::get('auth/google', [NguoidungController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [NguoidungController::class, 'handleGoogleCallback'])->name('google.callback');



Route::middleware(['checkdangnhap'])->group(function () {

    Route::middleware(['checkthanhtoan'])->group(function () {
        Route::get('/thanhtoan', [DonhangController::class, 'index'])->name('thanhtoan');
        Route::post('/checkout', [DonhangController::class, 'store'])->name('checkout');
    });
    Route::get('taikhoan', [NguoidungController::class, 'thongtincanhan'])->name('taikhoan');
    Route::get('dondathang', [NguoidungController::class, 'dondathang'])->name('dondathang');
    Route::get('quantam', [NguoidungController::class, 'quantam'])->name('quantam');
    Route::get('addquantam/{id}', [NguoidungController::class, 'addquantam'])->name('addquantam');
    Route::get('removequantam/{id}', [NguoidungController::class, 'removequantam'])->name('removequantam');
    Route::get('magiamgia', [NguoidungController::class, 'magiamgia'])->name('magiamgia');

    Route::post('/donhang/chitiet',  [GHNController::class, 'getChiTietDonHang'])->name('donhang.chitiet');

    Route::post('huydon/{id}', [NguoidungController::class, 'huydon'])->name('huydon');
    Route::get('datlai/{id}', [NguoidungController::class, 'datlai'])->name('datlai');
    Route::get('caidattaikhoan', [NguoidungController::class, 'caidattaikhoan'])->name('caidattaikhoan');
    Route::post('yeucaudoitra', [DoitraController::class, 'store'])->name('yeucaudoitra');
    Route::post('/doimatkhau', [NguoidungController::class, 'doimatkhau'])->name('doimatkhau');


    Route::get('nhanmagiamgia/{id}', [MagiamgiaController::class, 'nhanmgg'])->name('nhanmagiamgia');


    Route::middleware(['checkxacthuc'])->group(function () {
        Route::get('/email/verify', [VerificationController::class, 'showVerificationNotice'])
            ->middleware('auth')
            ->name('verification.notice');

        Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])
            ->middleware(['auth', 'signed'])
            ->name('verification.verify');

        Route::post('/email/verification-notification', [VerificationController::class, 'resendVerificationNotification'])
            ->middleware(['auth', 'throttle:6,1'])
            ->name('verification.send');
    });
});





Route::post('/layquanhuyen', [NguoidungController::class, 'getQuanHuyen'])->name('layquanhuyen');
Route::post('/calculate-shipping', [GHNController::class, 'calculateShipping'])->name('calculate-shipping');



Route::get('/hang', function () {
    return view('fe.pages.hang');
});


Route::get('/capnhatthongtin', function () {
    return view('fe.pages.capnhatthongtin');
});

Route::get('/tintuc', function () {
    return view('fe.pages.tintuc');
});

Route::get('/lienhe', function () {
    return view('fe.pages.taikhoan.lienhe');
});



Route::get('/a', function () {
    return view('login.a');
});
