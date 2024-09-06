<?php

namespace App\Http\Controllers;

use App\Models\Busram;
use App\Models\Chitietmagiamgia;
use App\Models\Congketnoi;
use App\Models\Cpu;
use App\Models\Danhgia;
use App\Models\Danhmuc;
use App\Models\Donhang;
use App\Models\Dophangiai;
use App\Models\Gpu;
use App\Models\Keycap;
use App\Models\Kieudangbanphim;
use App\Models\Kieutainghe;
use App\Models\Loaibanphim;
use App\Models\Loairam;
use App\Models\Luotxem;
use App\Models\Magiamgia;
use App\Models\Manhinh;
use App\Models\Nhacungcap;
use App\Models\Nhasanxuat;
use App\Models\Quatang;
use App\Models\Ram;
use App\Models\Sanpham;
use App\Models\Ssd;
use App\Models\Tamnen;
use App\Models\Tansoquet;
use App\Services\RecommendationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{

    protected $dexuat;

    public function __construct()
    {
        $this->dexuat = new RecommendationService();
    }


    public function index()
    {
        $dms = Danhmuc::all();
        $nsx = Nhasanxuat::all()->sortBy('ten');
        $sp = Sanpham::orderByDesc('daban')->paginate(9);
        // session()->forget('viewed_products');
        $viewedProducts = session()->get('viewed_products', []);
        $recommendSanphams = collect();
        $viewedSanphams = collect();
        $viewedSanphamss = collect();

        $dexuatmatrix = collect();

        $dexuatmatrixdonhang = collect();


        $mgg = Magiamgia::where('tinhtrang', 'public')->get();


        $currentMonth = now()->month;
        $currentYear = now()->year;

        $bestSellingProductIds = Donhang::join('chitietdonhang', 'donhang.id', '=', 'chitietdonhang.donhangid')
            ->whereMonth('donhang.updated_at', $currentMonth)
            ->whereYear('donhang.updated_at', $currentYear)
            ->where('donhang.tinhtrang', 'like', '%Hoàn thành%')
            ->select(
                'chitietdonhang.sanphamid',
            )
            ->groupBy('chitietdonhang.sanphamid')
            ->pluck('chitietdonhang.sanphamid');

        $banchaythang = Sanpham::whereIn('id', $bestSellingProductIds)->get();




        $ctmgg = [];
        if (Auth::check()) {
            $ctmgg = Chitietmagiamgia::where('nguoidungid', Auth::id())->pluck('magiamgiaid')->toArray();
        }
        if (Auth::check()) {
            session()->forget('viewed_products');
            $recommendSanphams = $this->dexuat->dexuatspchuaxem(Auth::id());
            // $dexuatmatrix = $this->dexuat->dexuatspmatrix(Auth::id());
            // $dexuatmatrixdonhang = $this->dexuat->dexuatspmuachua(Auth::id());
            $viewedSanphams = Luotxem::where('nguoidungid', Auth::id())->latest()->limit(10)->get();
        } elseif (!empty($viewedProducts)) {
            $sanphams = Sanpham::whereIn('id', $viewedProducts)->get();
            if ($sanphams->isNotEmpty()) {
                $danhmucCounts = array_count_values($sanphams->pluck('danhmucid')->toArray());
                $nhasanxuatCounts = array_count_values($sanphams->pluck('nhasanxuatid')->toArray());
                arsort($danhmucCounts);
                $mostCommonDanhmucIds = array_slice(array_keys($danhmucCounts), 0, 2);

                $mostCommonNhasanxuatId = array_search(max($nhasanxuatCounts), $nhasanxuatCounts);
                $giaTrungBinh = $sanphams->avg('gia');
                $recommendSanphams = Sanpham::whereIn('danhmucid', $mostCommonDanhmucIds)
                    ->where('nhasanxuatid', $mostCommonNhasanxuatId)
                    ->where('gia', '<=', $giaTrungBinh + 5000000)
                    ->where('gia', '>=', $giaTrungBinh - 5000000)
                    ->take(10)
                    ->get();
                $sortedViewedProducts = array_reverse($viewedProducts);
                $viewedSanphamss = Sanpham::whereIn('id', $sortedViewedProducts)
                    ->orderByRaw('FIELD(id, ' . implode(',', $sortedViewedProducts) . ')')
                    ->get();
            }
        }

        // dd($dexuatmatrix);


        // dd($viewedSanphamss);
        return view('fe.pages.home', compact('nsx', 'dms', 'sp', 'recommendSanphams', 'viewedSanphams', 'mgg', 'ctmgg', 'viewedSanphamss', 'dexuatmatrix', 'banchaythang', 'dexuatmatrixdonhang'));
    }



    public function danhsachsp()
    {
        $nsx = Nhasanxuat::all();
        $ncc = Nhacungcap::all();
        $dms = Danhmuc::all();
        $cpu = Cpu::all();
        $gpu = Gpu::all();
        $ram = Ram::all();
        $ssd = Ssd::all();
        $manhinh = Manhinh::all();
        $sp = Sanpham::with(['danhmuc', 'hinhanhsanphams', 'thongsohieunang.rams', 'thongsohieunang.cpus', 'thongsohieunang.gpurois', 'thongsoluutru', 'thongsomanhinh.kichthuocs'])->get();
        return view('fe.pages.danhsachsp', compact('nsx', 'ncc', 'dms', 'cpu', 'gpu', 'ram', 'sp', 'ssd', 'manhinh'));
    }
    public function danhsachdanhmuc(string $id)
    {
        $ncc = Nhacungcap::all();
        $dms = Danhmuc::all();

        $cpu = Cpu::all();
        $gpu = Gpu::all();
        $ram = Ram::all();
        $ssd = Ssd::all();
        $manhinh = Manhinh::all();
        $loaibanphim = Loaibanphim::all();
        $kieudangbanphim = Kieudangbanphim::all();
        $keycap = Keycap::all();
        $tocdobus = Busram::all();
        $loairam = Loairam::all();
        $dophangiai = Dophangiai::all();
        $tamnen = Tamnen::all();
        $tansoquet = Tansoquet::all();
        $kieutainghe = Kieutainghe::all();
        $congketnoi = Congketnoi::all();

        $dm = Danhmuc::findOrFail($id);

        $dmcon = Danhmuc::where('parentid', $id)->get();


        $dmid = Danhmuc::where('id', $id)
            ->orWhere('parentid', $id)
            ->pluck('id')
            ->toArray();


        $sp = Sanpham::with(['danhmuc', 'hinhanhsanphams', 'thongsohieunang.rams', 'thongsohieunang.cpus', 'thongsohieunang.gpurois', 'thongsoluutru', 'thongsomanhinh', 'thongsopkbanphim', 'thongsopkram', 'thongsopktainghe', 'thongsopkchuot', 'thongsopkmanhinh'])
            ->whereIn('danhmucid', $dmid)
            ->orderBy('id', 'asc')
            ->paginate(9);
        $sp1 = Sanpham::with(['danhmuc', 'hinhanhsanphams', 'thongsohieunang.rams', 'thongsohieunang.cpus', 'thongsohieunang.gpurois', 'thongsoluutru', 'thongsomanhinh', 'thongsopkbanphim', 'thongsopkram', 'thongsopktainghe', 'thongsopkchuot', 'thongsopkmanhinh'])
            ->where('danhmucid', $dmid)
            ->get();
        $nsx = $sp1->map->nhasanxuat->unique('id');

        // $keycap = $sp->pluck('thongsopkbanphim.keycaps')->flatten()->unique('id');
        return view(
            'fe.pages.danhsachdanhmuc',
            compact(
                'nsx',
                'ncc',
                'dms',
                'cpu',
                'gpu',
                'ram',
                'sp',
                'ssd',
                'manhinh',
                'dm',
                'loaibanphim',
                'kieudangbanphim',
                'keycap',
                'tocdobus',
                'loairam',
                'dophangiai',
                'tamnen',
                'tansoquet',
                'kieutainghe',
                'congketnoi',
                'dmcon'
            )
        );
    }
    public function chitietsp(string $id)
    {
        $nsx = Nhasanxuat::all();
        $ncc = Nhacungcap::all();
        $dms = Danhmuc::all();
        $sp = Sanpham::with(['danhmuc', 'hinhanhsanphams', 'thongsohieunang.rams', 'thongsohieunang.cpus', 'thongsohieunang.gpurois', 'thongsoluutru', 'thongsomanhinh', 'thongsopkbanphim', 'thongsopkram', 'thongsopktainghe', 'thongsopkchuot', 'thongsopkmanhinh'])->findOrFail($id);
        $dm = Danhmuc::findOrFail($sp->danhmucid);
        $quatangs = Quatang::where('sanphamid', $sp->id)->get();
        $sptt = Sanpham::with('hinhanhsanphams')
            ->where('danhmucid', $sp->danhmucid)
            ->where('nhasanxuatid', $sp->nhasanxuatid)
            ->get();
        $danhgias = Danhgia::where('sanphamid', $sp->id)->orderByDesc('created_at')->get();
        $diemtb1 = Danhgia::where('sanphamid', $sp->id)->avg('diem');
        $diemtb = round($diemtb1, 2);

        if (Auth::check()) {
            $donhangs = Donhang::where('nguoidungid', Auth::user()->id)
                ->where('tinhtrang', 'Hoàn Thành')
                ->whereHas('chitietdonhangs', function ($query) use ($sp) {
                    $query->where('sanphamid', $sp->id);
                })
                ->where('ngaydat', '>=', Carbon::now()->subDays(5))
                ->get();
            $canReview = $donhangs->isNotEmpty();
        }
        $canReview = '';

        $sanpham = Sanpham::find($id);

        if (Auth::check()) {
            $nguoidungid = Auth::id();
            try {
                $luotxem = Luotxem::firstOrCreate(
                    [
                        'nguoidungid' => $nguoidungid,
                        'sanphamid' => $id,
                    ],
                    [
                        'updated_at' => now()
                    ]
                );
            } catch (Exception $e) {
                Log::info('Lỗi khi add vào lượt xem ' . $e->getMessage());
            }
        } else {
            if ($sanpham) {
                $viewedProducts = session()->get('viewed_products', []);
                if (!in_array($id, $viewedProducts)) {
                    $viewedProducts[] = $id;
                    if (count($viewedProducts) > 10) {
                        array_shift($viewedProducts);
                    }
                    session()->put('viewed_products', $viewedProducts);
                }
            }
        }
        return view('fe.pages.chitietsp', compact('sp', 'dms', 'dm', 'nsx', 'ncc', 'sptt', 'quatangs', 'danhgias', 'diemtb', 'canReview'));
    }

    public function filterProducts(Request $request)
    {
        try {
            $filters = $request->input('filters', []);
            $query = Sanpham::query();


            if (isset($filters['minPrice']) && isset($filters['maxPrice'])) {
                $query->whereBetween('gia', [$filters['minPrice'], $filters['maxPrice']]);
            }

            if (isset($filters['brand'])) {
                $query->whereIn('nhasanxuatid', $filters['brand']);
            }


            if (isset($filters['screen-size'])) {
                $query->whereHas('thongsomanhinh', function ($q) use ($filters) {
                    $q->whereIn('kichthuoc', $filters['screen-size']);
                });
            }
            if (isset($filters['cpu'])) {
                $query->whereHas('thongsohieunang', function ($q) use ($filters) {
                    $q->whereIn('cpu', $filters['cpu']);
                });
            }
            if (isset($filters['gpuroi'])) {
                $query->whereHas('thongsohieunang', function ($q) use ($filters) {
                    $q->whereIn('gpuroi', $filters['gpuroi']);
                });
            }
            if (isset($filters['ram'])) {
                $query->whereHas('thongsohieunang', function ($q) use ($filters) {
                    $q->whereIn('ram', $filters['ram']);
                });
            }

            if (isset($filters['ssd'])) {
                $query->whereHas('thongsoluutru', function ($q) use ($filters) {
                    $q->whereIn('tongdungluong', $filters['ssd']);
                });
            }


            $products = $query->get();
            return view('fe.pages.partials.product_list', compact('products'));
        } catch (\Exception $e) {
            Log::error('Error filtering products: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra trong quá trình lọc sản phẩm'], 500);
        }
    }

    public function filterProductsdm(Request $request, string $id)
    {
        try {
            $filters = $request->input('filters', []);

            $dmid = Danhmuc::where('id', $id)
                ->orWhere('parentid', $id)
                ->pluck('id')
                ->toArray();

            $query = Sanpham::query()->whereIn('danhmucid', $dmid);

            if (isset($filters['minPrice']) && isset($filters['maxPrice'])) {
                $query->whereBetween('gia', [$filters['minPrice'], $filters['maxPrice']]);
            }

            if (isset($filters['brand'])) {
                $query->whereIn('nhasanxuatid', $filters['brand']);
            }

            if (isset($filters['dmcon'])) {
                $query->whereIn('danhmucid', $filters['dmcon']);
            }


            if (isset($filters['screen-size'])) {
                $query->whereHas('thongsomanhinh', function ($q) use ($filters) {
                    $q->whereIn('kichthuoc', $filters['screen-size']);
                });
            }
            if (isset($filters['cpu'])) {
                $query->whereHas('thongsohieunang', function ($q) use ($filters) {
                    $q->whereIn('cpu', $filters['cpu']);
                });
            }
            if (isset($filters['gpuroi'])) {
                $query->whereHas('thongsohieunang', function ($q) use ($filters) {
                    $q->whereIn('gpuroi', $filters['gpuroi']);
                });
            }
            if (isset($filters['ram'])) {
                $query->whereHas('thongsohieunang', function ($q) use ($filters) {
                    $q->whereIn('ram', $filters['ram']);
                });
            }

            if (isset($filters['ssd'])) {
                $query->whereHas('thongsoluutru', function ($q) use ($filters) {
                    $q->whereIn('tongdungluong', $filters['ssd']);
                });
            }
            if (isset($filters['loaibanphim'])) {
                $query->whereHas('thongsopkbanphim', function ($q) use ($filters) {
                    $q->whereIn('loaibanphim', $filters['loaibanphim']);
                });
            }
            if (isset($filters['kieudangbanphim'])) {
                $query->whereHas('thongsopkbanphim', function ($q) use ($filters) {
                    $q->whereIn('kieudangbanphim', $filters['kieudangbanphim']);
                });
            }
            if (isset($filters['keycap'])) {
                $query->whereHas('thongsopkbanphim', function ($q) use ($filters) {
                    $q->whereIn('keycap', $filters['keycap']);
                });
            }
            if (isset($filters['dlram'])) {
                $query->whereHas('thongsopkram', function ($q) use ($filters) {
                    $q->whereIn('dungluong', $filters['dlram']);
                });
            }
            if (isset($filters['tocdobus'])) {
                $query->whereHas('thongsopkram', function ($q) use ($filters) {
                    $q->whereIn('tocdobus', $filters['tocdobus']);
                });
            }
            if (isset($filters['loairam'])) {
                $query->whereHas('thongsopkram', function ($q) use ($filters) {
                    $q->whereIn('loairam', $filters['loairam']);
                });
            }

            if (isset($filters['ktmanhinh'])) {
                $query->whereHas('thongsopkmanhinh', function ($q) use ($filters) {
                    $q->whereIn('kichthuoc', $filters['ktmanhinh']);
                });
            }
            if (isset($filters['dophangiai'])) {
                $query->whereHas('thongsopkmanhinh', function ($q) use ($filters) {
                    $q->whereIn('dophangiai', $filters['dophangiai']);
                });
            }

            if (isset($filters['tamnen'])) {
                $query->whereHas('thongsopkmanhinh', function ($q) use ($filters) {
                    $q->whereIn('tamnen', $filters['tamnen']);
                });
            }

            if (isset($filters['tansoquet'])) {
                $query->whereHas('thongsopkmanhinh', function ($q) use ($filters) {
                    $q->whereIn('tansoquet', $filters['tansoquet']);
                });
            }


            if (isset($filters['loaiketnoi'])) {
                $query->whereHas('thongsopktainghe', function ($q) use ($filters) {
                    $q->whereIn('loaiketnoi', $filters['loaiketnoi']);
                });
            }

            if (isset($filters['kieutainghe'])) {
                $query->whereHas('thongsopktainghe', function ($q) use ($filters) {
                    $q->whereIn('kieutainghe', $filters['kieutainghe']);
                });
            }

            if (isset($filters['congketnoi'])) {
                $query->whereHas('thongsopktainghe', function ($q) use ($filters) {
                    $q->whereIn('congketnoi', $filters['congketnoi']);
                });
            }

            if (isset($filters['loaiketnoichuot'])) {
                $query->whereHas('thongsopkchuot', function ($q) use ($filters) {
                    $q->whereIn('loaiketnoi', $filters['loaiketnoichuot']);
                });
            }
            if (isset($filters['kieuketnoichuot'])) {
                $query->whereHas('thongsopkchuot', function ($q) use ($filters) {
                    $q->whereIn('kieuketnoi', $filters['kieuketnoichuot']);
                });
            }


            if (isset($filters['sort'])) {
                if ($filters['sort'] == 1) {
                    $query->orderBy('daban', 'desc');
                } elseif ($filters['sort'] == 2) {
                    $query->orderBy('gia', 'asc');
                } elseif ($filters['sort'] == 3) {
                    $query->orderBy('gia', 'desc');
                } elseif ($filters['sort'] == 4) {
                    $query->orderBy('created_at', 'desc');
                }
            }
            // $products = $query->get();
            $products = $query->orderBy('id', 'asc')->paginate(9);
            return view('fe.pages.partials.product_list', compact('products'));
        } catch (\Exception $e) {
            Log::error('Error filtering products: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra trong quá trình lọc sản phẩm'], 500);
        }
    }

    public function filterProductsgiamgia(Request $request)
    {
        try {
            $filters = $request->input('filters', []);


            $query = Sanpham::query()->where(function ($query) {
                $query->whereHas('giamgia', function ($query) {
                    $query->where('danggiam', 1);
                })->orWhereHas('giamgiahangloat', function ($query) {
                    $query->where('tinhtrang', 1);
                });
            });


            if (isset($filters['minPrice']) && isset($filters['maxPrice'])) {
                $query->whereBetween('gia', [$filters['minPrice'], $filters['maxPrice']]);
            }

            if (isset($filters['brand'])) {
                $query->whereIn('nhasanxuatid', $filters['brand']);
            }
            if (isset($filters['screen-size'])) {
                $query->whereHas('thongsomanhinh', function ($q) use ($filters) {
                    $q->whereIn('kichthuoc', $filters['screen-size']);
                });
            }
            if (isset($filters['cpu'])) {
                $query->whereHas('thongsohieunang', function ($q) use ($filters) {
                    $q->whereIn('cpu', $filters['cpu']);
                });
            }
            if (isset($filters['gpuroi'])) {
                $query->whereHas('thongsohieunang', function ($q) use ($filters) {
                    $q->whereIn('gpuroi', $filters['gpuroi']);
                });
            }
            if (isset($filters['ram'])) {
                $query->whereHas('thongsohieunang', function ($q) use ($filters) {
                    $q->whereIn('ram', $filters['ram']);
                });
            }

            if (isset($filters['ssd'])) {
                $query->whereHas('thongsoluutru', function ($q) use ($filters) {
                    $q->whereIn('tongdungluong', $filters['ssd']);
                });
            }
            if (isset($filters['loaibanphim'])) {
                $query->whereHas('thongsopkbanphim', function ($q) use ($filters) {
                    $q->whereIn('loaibanphim', $filters['loaibanphim']);
                });
            }
            if (isset($filters['kieudangbanphim'])) {
                $query->whereHas('thongsopkbanphim', function ($q) use ($filters) {
                    $q->whereIn('kieudangbanphim', $filters['kieudangbanphim']);
                });
            }
            if (isset($filters['keycap'])) {
                $query->whereHas('thongsopkbanphim', function ($q) use ($filters) {
                    $q->whereIn('keycap', $filters['keycap']);
                });
            }
            if (isset($filters['dlram'])) {
                $query->whereHas('thongsopkram', function ($q) use ($filters) {
                    $q->whereIn('dungluong', $filters['dlram']);
                });
            }
            if (isset($filters['tocdobus'])) {
                $query->whereHas('thongsopkram', function ($q) use ($filters) {
                    $q->whereIn('tocdobus', $filters['tocdobus']);
                });
            }
            if (isset($filters['loairam'])) {
                $query->whereHas('thongsopkram', function ($q) use ($filters) {
                    $q->whereIn('loairam', $filters['loairam']);
                });
            }

            if (isset($filters['ktmanhinh'])) {
                $query->whereHas('thongsopkmanhinh', function ($q) use ($filters) {
                    $q->whereIn('kichthuoc', $filters['ktmanhinh']);
                });
            }
            if (isset($filters['dophangiai'])) {
                $query->whereHas('thongsopkmanhinh', function ($q) use ($filters) {
                    $q->whereIn('dophangiai', $filters['dophangiai']);
                });
            }

            if (isset($filters['tamnen'])) {
                $query->whereHas('thongsopkmanhinh', function ($q) use ($filters) {
                    $q->whereIn('tamnen', $filters['tamnen']);
                });
            }

            if (isset($filters['tansoquet'])) {
                $query->whereHas('thongsopkmanhinh', function ($q) use ($filters) {
                    $q->whereIn('tansoquet', $filters['tansoquet']);
                });
            }


            if (isset($filters['loaiketnoi'])) {
                $query->whereHas('thongsopktainghe', function ($q) use ($filters) {
                    $q->whereIn('loaiketnoi', $filters['loaiketnoi']);
                });
            }

            if (isset($filters['kieutainghe'])) {
                $query->whereHas('thongsopktainghe', function ($q) use ($filters) {
                    $q->whereIn('kieutainghe', $filters['kieutainghe']);
                });
            }

            if (isset($filters['congketnoi'])) {
                $query->whereHas('thongsopktainghe', function ($q) use ($filters) {
                    $q->whereIn('congketnoi', $filters['congketnoi']);
                });
            }

            if (isset($filters['loaiketnoichuot'])) {
                $query->whereHas('thongsopkchuot', function ($q) use ($filters) {
                    $q->whereIn('loaiketnoi', $filters['loaiketnoichuot']);
                });
            }
            if (isset($filters['kieuketnoichuot'])) {
                $query->whereHas('thongsopkchuot', function ($q) use ($filters) {
                    $q->whereIn('kieuketnoi', $filters['kieuketnoichuot']);
                });
            }


            if (isset($filters['sort'])) {
                if ($filters['sort'] == 1) {
                    $query->orderBy('daban', 'desc');
                } elseif ($filters['sort'] == 2) {
                    $query->orderBy('gia', 'asc');
                } elseif ($filters['sort'] == 3) {
                    $query->orderBy('gia', 'desc');
                } elseif ($filters['sort'] == 4) {
                    $query->orderBy('created_at', 'desc');
                }
            }
            // $products = $query->get();
            $products = $query->paginate(9);
            return view('fe.pages.partials.product_list', compact('products'));
        } catch (\Exception $e) {
            Log::error('Error filtering products: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra trong quá trình lọc sản phẩm'], 500);
        }
    }

    public function autocomplete(Request $request)
    {
        $keyword = $request->get('keyword');
        $keywords = explode(' ', $keyword);

        $query = Sanpham::select('id', 'ten', 'gia')
            ->with('hinhanhsanphams') // Eager load images
            ->where(function ($q) use ($keywords) {
                foreach ($keywords as $key) {
                    $q->orWhere('ten', 'like', '%' . $key . '%');
                }
            });

        $products = $query->limit(10)->get();


        $products->map(function ($product) {
            $product->hinhanhsanphams = $product->hinhanhsanphams->map(function ($image) {
                $image->img = asset('back-end/img/sp/' . $image->img);
                return $image;
            });
            return $product;
        });

        return response()->json($products);
    }


    public function timkiem(Request $request)
    {


        $keyword = $request->get('keyword');
        $keywords = explode(' ', $keyword);

        $query = Sanpham::query();

        foreach ($keywords as $word) {
            $query->where(function ($q) use ($word) {
                $q->where('ten', 'like', '%' . $word . '%')
                    ->orWhereHas('thongsohieunang.cpus', function ($q) use ($word) {
                        $q->where('ten', 'like', '%' . $word . '%');
                    })
                    ->orWhereHas('thongsohieunang.rams', function ($q) use ($word) {
                        $q->where('ten', 'like', '%' . $word . '%');
                    })
                    ->orWhereHas('thongsohieunang.gpurois', function ($q) use ($word) {
                        $q->where('ten', 'like', '%' . $word . '%');
                    });
            });
        }

        $products = $query->get();

        // Debug query
        // dd($query->toSql(), $query->getBindings());


        $ncc = Nhacungcap::all();
        $dms = Danhmuc::all();
        $cpu = Cpu::all();
        $gpu = Gpu::all();
        $ram = Ram::all();
        $ssd = Ssd::all();
        $manhinh = Manhinh::all();
        $loaibanphim = Loaibanphim::all();
        $kieudangbanphim = Kieudangbanphim::all();
        $keycap = Keycap::all();
        $tocdobus = Busram::all();
        $loairam = Loairam::all();
        $dophangiai = Dophangiai::all();
        $tamnen = Tamnen::all();
        $tansoquet = Tansoquet::all();
        $kieutainghe = Kieutainghe::all();
        $congketnoi = Congketnoi::all();
        $nsx = Nhasanxuat::all();

        return view('fe.pages.timkiemsp', compact(
            'nsx',
            'ncc',
            'dms',
            'cpu',
            'gpu',
            'ram',
            'products',
            'ssd',
            'manhinh',
            'loaibanphim',
            'kieudangbanphim',
            'keycap',
            'tocdobus',
            'loairam',
            'dophangiai',
            'tamnen',
            'tansoquet',
            'kieutainghe',
            'congketnoi',
            'keyword',
        ));
    }



    public function spgiamgia()
    {
        $sanphams = Sanpham::all();
        $ncc = Nhacungcap::all();
        $dms = Danhmuc::all();
        $dm = Danhmuc::all();
        $cpu = Cpu::all();
        $gpu = Gpu::all();
        $ram = Ram::all();
        $ssd = Ssd::all();
        $manhinh = Manhinh::all();
        $loaibanphim = Loaibanphim::all();
        $kieudangbanphim = Kieudangbanphim::all();
        $keycap = Keycap::all();
        $tocdobus = Busram::all();
        $loairam = Loairam::all();
        $dophangiai = Dophangiai::all();
        $tamnen = Tamnen::all();
        $tansoquet = Tansoquet::all();
        $kieutainghe = Kieutainghe::all();
        $congketnoi = Congketnoi::all();
        $sp = $sanphams->filter(function ($sanpham) {
            return ($sanpham->giamgia && $sanpham->giamgia->danggiam == 1) || ($sanpham->giamgiahangloat && $sanpham->giamgiahangloat->tinhtrang == 1);
        });
        $nsx = $sp->map->nhasanxuat->unique('id');
        return view('fe.pages.spgiamgia', compact(
            'nsx',
            'ncc',
            'dms',
            'cpu',
            'gpu',
            'ram',
            'sp',
            'ssd',
            'manhinh',
            'dm',
            'loaibanphim',
            'kieudangbanphim',
            'keycap',
            'tocdobus',
            'loairam',
            'dophangiai',
            'tamnen',
            'tansoquet',
            'kieutainghe',
            'congketnoi'
        ));
    }
}
