<?php

namespace App\Http\Controllers;

use App\Models\Donhang;
use App\Models\Giohang;
use App\Models\Nguoidung;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GHNController extends Controller
{
    protected $endpoint = "https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create";
    protected $token = 'ed18934b-2b2c-11ef-8e53-0a00184fe694';
    protected $shopId = '192598';

    public function createShippingOrder($id)
    {
        try {
            $donhang = Donhang::findOrFail($id);
            $nguoidung = $donhang->nguoidung;

            $tien = $donhang->tongtien < 50000000 ? $donhang->tongtien : 49000000;
            $thuho = $donhang->phuongthucthanhtoanid == 1 ? (int) $tien : 0;

            $items = $this->prepareItems($donhang->chitietdonhangs);
            $totalWeight = $this->calculateTotalWeight($donhang->chitietdonhangs);

            $data = $this->prepareData($nguoidung, $thuho, $items, $donhang, $totalWeight);

            // Log dữ liệu sẽ được gửi đi
            Log::info('Gửi request tạo đơn hàng', ['request_data' => $data]);
            $response = $this->sendRequest($data);

            if (isset($response['data']['order_code'])) {
                $donhang->update([
                    'mavandon' => $response['data']['order_code'],
                    'tinhtrang' => 'Đã xác nhận',
                ]);
                return redirect()->back()->with('suc', 'Tạo đơn hàng thành công. Mã đơn hàng: ' . $response['data']['order_code']);
            } else {
                $errorMessage = 'Đã có lỗi xảy ra trong quá trình tạo đơn hàng.';
                Log::error($errorMessage, ['response' => $response]);
                return redirect()->back()->with('err', $errorMessage);
            }
        } catch (\Exception $e) {
            $errorMessage = 'Lỗi xảy ra khi tạo đơn hàng: ' . $e->getMessage();
            Log::error($errorMessage, ['exception' => $e]);
            return redirect()->back()->with('err', $errorMessage);
        }
    }

    protected function prepareItems($chitietdonhangs)
    {
        $items = [];
        foreach ($chitietdonhangs as $chitiet) {
            $items[] = [
                "name" => $chitiet->sanpham->ten,
                "code" => (string) $chitiet->sanpham->id,
                "quantity" => (int) $chitiet->soluong,
                "price" => (int) $chitiet->gia,
                "length" => 1,
                "width" => 1,
                "height" => 1,
                "weight" => (int) $chitiet->sanpham->thongsotongquat?->trongluong * 1000,
                "category" => [
                    "level1" => $chitiet->sanpham->danhmuc->ten
                ]
            ];
        }
        return $items;
    }

    protected function calculateTotalWeight($chitietdonhangs)
    {
        $totalWeight = 0;
        foreach ($chitietdonhangs as $chitiet) {
            $totalWeight += $chitiet->sanpham->thongsotongquat?->trongluong * $chitiet->soluong * 1000;
        }
        return $totalWeight;
    }

    protected function prepareData($nguoidung, $thuho, $items, $donhang, $totalWeight)
    {
        $pttt_id = $donhang->phuongthucthanhtoan->ten == 'VNPay' ||  $donhang->phuongthucthanhtoan->ten == 'MoMo' ? 2 : 1;
        return [
            "payment_type_id" =>$pttt_id,
            "note" => "Note là không có note",
            "required_note" => "KHONGCHOXEMHANG",
            "from_name" => "VinMeepShop",
            "from_phone" => "1900100100",
            "from_address" => "180 Cao Lỗ, Phường 4, Quận 8, Hồ Chí Minh, Vietnam",
            "from_ward_name" => "Phường 4",
            "from_district_name" => "Quận 8",
            "from_province_name" => "HCM",
            "return_phone" => "0332190444",
            "return_address" => "39 NTT",
            "client_order_code" => "",
            "to_name" => $nguoidung->ten,
            "to_phone" => $nguoidung->sodienthoai,
            "to_address" => $nguoidung->diachi,
            "to_ward_code" => (string) $nguoidung->xaid,
            "to_district_id" => (int) $nguoidung->maqh,
            "cod_amount" => $thuho,
            "content" => "Theo New York Times",
            "weight" => (int) $totalWeight,
            "length" => 1,
            "width" => 19,
            "height" => 10,
            "pick_station_id" => 1444,
            "insurance_value" => 4000000,
            "service_id" => 0,
            "service_type_id" => 2,
            "pick_shift" => [1],
            "items" => $items
        ];
    }

    protected function sendRequest($data)
    {
        try {
            $client = new Client(['verify' => false]);
            $response = $client->post($this->endpoint, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Token' => $this->token,
                    'ShopId' => $this->shopId
                ],
                'json' => $data
            ]);

            $body = $response->getBody();
            $content = $body->getContents();
            $jsonResult = json_decode($content, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return ['error' => 'JSON Decode Error: ' . json_last_error_msg()];
            }

            return $jsonResult;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('Client error: ' . $e->getMessage());
            $responseBody = $e->getResponse()->getBody(true);
            $responseJson = json_decode($responseBody, true);
            return [
                'error' => 'Client error',
                'message' => $responseJson['message'] ?? 'Unknown error'
            ];
        } catch (\Exception $e) {
            Log::error('Server error: ' . $e->getMessage());
            return [
                'error' => 'Server error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function capnhattrangthai()
    {
        $orders = Donhang::whereNotNull('mavandon')->get();
        $client = new Client(['verify' => false]);
        $errors = [];

        foreach ($orders as $i) {
            try {
                $response = $client->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/detail', [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Token' => $this->token
                    ],
                    'json' => [
                        'order_code' => $i->mavandon
                    ]
                ]);
                $data = json_decode($response->getBody(), true);
                if (isset($data['data']['status'])) {
                    if ($data['data']['status'] == 'ready_to_pick') {
                        $i->tinhtrang = 'Đã xác nhận';
                    } elseif ($data['data']['status'] == 'picking') {
                        $i->tinhtrang = 'Đang lấy hàng';
                    } elseif ($data['data']['status'] == 'cancel') {
                        $i->tinhtrang = 'Đã hủy';
                    } elseif ($data['data']['status'] == 'money_collect_picking') {
                        $i->tinhtrang = 'Đang thu tiền lấy hàng';
                    } elseif ($data['data']['status'] == 'picked') {
                        $i->tinhtrang = 'Đã lấy hàng';
                    } elseif ($data['data']['status'] == 'storing') {
                        $i->tinhtrang = 'Đang lưu kho';
                    } elseif ($data['data']['status'] == 'transporting') {
                        $i->tinhtrang = 'Đang luân chuyển';
                    } elseif ($data['data']['status'] == 'sorting') {
                        $i->tinhtrang = 'Đang phân loại';
                    } elseif ($data['data']['status'] == 'delivering') {
                        $i->tinhtrang = 'Đang giao hàng';
                    } elseif ($data['data']['status'] == 'money_collect_delivering') {
                        $i->tinhtrang = 'Đang thu tiền giao hàng';
                    } elseif ($data['data']['status'] == 'delivered') {
                        $i->tinhtrang = 'Đã giao hàng';
                    } elseif ($data['data']['status'] == 'delivery_fail') {
                        $i->tinhtrang = 'Giao hàng thất bại';
                    } elseif ($data['data']['status'] == 'waiting_to_return') {
                        $i->tinhtrang = 'Đang chờ trả hàng';
                    } elseif ($data['data']['status'] == 'return') {
                        $i->tinhtrang = 'Đang trả hàng';
                    } elseif ($data['data']['status'] == 'return_transporting') {
                        $i->tinhtrang = 'Đang luân chuyển trả hàng';
                    } elseif ($data['data']['status'] == 'return_sorting') {
                        $i->tinhtrang = 'Đang phân loại trả hàng';
                    } elseif ($data['data']['status'] == 'returning') {
                        $i->tinhtrang = 'Đang trả hàng';
                    } elseif ($data['data']['status'] == 'return_fail') {
                        $i->tinhtrang = 'Trả hàng thất bại';
                    } elseif ($data['data']['status'] == 'returned') {
                        $i->tinhtrang = 'Đã trả hàng';
                    } elseif ($data['data']['status'] == 'exception') {
                        $i->tinhtrang = 'Xử lý ngoại lệ';
                    } elseif ($data['data']['status'] == 'damage') {
                        $i->tinhtrang = 'Hàng hỏng';
                    } elseif ($data['data']['status'] == 'lost') {
                        $i->tinhtrang = 'Hàng mất';
                    } else {
                        $i->tinhtrang = 'Không xác định';
                    }
                    $i->save();
                }
            } catch (\Exception $e) {
                $errors[] = 'Error updating order status for order ' . $i->mavandon . ': ' . $e->getMessage();
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->with('err', implode('<br>', $errors));
        } else {
            return redirect()->back()->with('suc', 'Thành công cập nhật ' . count($orders) . ' đơn hàng');
        }
    }

    public function calculateShipping(Request $request)
    {
        try {
            $toDistrictId = (int) $request->to_district_id;
            $towardid = (string) $request->to_ward_code;
            $height = 50;
            $length = 20;
            $width = 20;
            $insuranceValue = (int) $request->insurance_value;
            $codFailedAmount = (int) $request->cod_failed_amount;


            $nguoidungId = $request->nguoidung_id;
            $totalWeight = $this->calculateTotalWeightByNguoidungId($nguoidungId);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Token' => $this->token,
                'ShopId' => $this->shopId
            ])->withOptions(['verify' => false])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/fee', [
                'from_district_id' => 1450,
                'from_ward_code' => '20804',
                'service_id' => 53320,
                'service_type_id' => null,
                'to_district_id' => $toDistrictId,
                'to_ward_code' => $towardid,
                'height' => $height,
                'length' => $length,
                'weight' => $totalWeight,
                'width' => $width,
                'insurance_value' => $insuranceValue,
                'cod_failed_amount' => $codFailedAmount,
                'coupon' => $request->coupon
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
            } else {
                Log::error('Error calculating shipping fee', ['response' => $response->json()]);
                return response()->json(['error' => 'Unable to calculate shipping fee'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Exception when calculating shipping fee', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Server error when calculating shipping fee'], 500);
        }
    }
    protected function calculateTotalWeightByNguoidungId($nguoidungId)
    {
        try {
            $giohang = Giohang::where('nguoidungid', $nguoidungId)->firstOrFail();
            $chitietgiohangs = $giohang->chitietgiohangs()->with('sanpham.thongsotongquat')->get();
            $totalWeight = 0;

            foreach ($chitietgiohangs as $chitietgiohang) {
                $sanpham = $chitietgiohang->sanpham;
                $soLuong = $chitietgiohang->soluong;
                $trongLuong = $sanpham->thongsotongquat ? $sanpham->thongsotongquat->trongluong : 0;
                $totalWeight += $trongLuong * $soLuong * 1000;
            }

            return $totalWeight;
        } catch (\Exception $e) {
            throw new \Exception('Error calculating total weight: ' . $e->getMessage());
        }
    }

    public function getChiTietDonHang(Request $request)
    {
        $mavandon = $request->input('mavandon');

        $response = Http::withHeaders([
            'Token' => $this->token,
            'ShopId' => $this->shopId
        ])->withOptions(['verify' => false])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/detail', [
            'order_code' => $mavandon
        ]);

        if ($response->successful()) {
            $data = $response->json()['data'];
            $orderDate = isset($data['order_date']) ? $data['order_date'] : null;
            $log = isset($data['log']) ? $data['log'] : [];
            $leadtime = isset($data['leadtime']) ? $data['leadtime'] : null;

            return response()->json(['order_date' => $orderDate, 'log' => $log, 'leadtime' => $leadtime]);
        } else {
            return response()->json(['error' => 'Failed to fetch order details'], 500);
        }
    }
}
