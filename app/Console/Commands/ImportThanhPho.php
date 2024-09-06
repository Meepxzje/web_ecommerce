<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Thanhpho;
use App\Models\Quanhuyen;
use App\Models\Xaphuong;

class ImportThanhPho extends Command
{
    protected $signature = 'import:thanhpho';
    protected $description = 'Import thành phố, quận huyện và xã phường từ API của GHN';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Import thành phố
        $this->importThanhPho();

        // Import quận huyện
        $this->importQuanHuyen();

        // Import xã phường
        $this->importXaPhuong();
    }

    private function importThanhPho()
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Token' => 'ed18934b-2b2c-11ef-8e53-0a00184fe694',
            ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/province');

        $data = $response->json();

        if ($data['code'] == 200 && isset($data['data'])) {
            foreach ($data['data'] as $province) {
                Thanhpho::updateOrCreate(
                    ['matp' => $province['ProvinceID']],
                    [
                        'name' => $province['ProvinceName'],
                        'type' => $province['NameExtension'][0] ?? '',
                        'matp' => $province['ProvinceID'],
                    ]
                );
            }
            $this->info('Đã nhập thành công các tỉnh thành phố.');
        } else {
            $this->error('Lỗi khi gọi API hoặc dữ liệu không hợp lệ.');
        }
    }

    private function importQuanHuyen()
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Token' => 'ed18934b-2b2c-11ef-8e53-0a00184fe694',
            ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/district');

        $data = $response->json();

        if ($data['code'] == 200 && isset($data['data'])) {
            foreach ($data['data'] as $district) {
                Quanhuyen::updateOrCreate(
                    ['maqh' => $district['DistrictID']],
                    [
                        'name' => $district['DistrictName'],
                        'type' => $district['NameExtension'][0] ?? '',
                        'matp' => $district['ProvinceID'],
                        'maqh' => $district['DistrictID'],
                    ]
                );
            }
            $this->info('Đã nhập thành công các quận huyện.');
        } else {
            $this->error('Lỗi khi gọi API hoặc dữ liệu không hợp lệ.');
        }
    }

    private function importXaPhuong()
    {
        $districts = Quanhuyen::all();

        foreach ($districts as $district) {
            $response = Http::withOptions(['verify' => false])
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Token' => 'ed18934b-2b2c-11ef-8e53-0a00184fe694',
                ])->get('https://dev-online-gateway.ghn.vn/shiip/public-api/master-data/ward', [
                    'district_id' => $district->maqh
                ]);

            $data = $response->json();

            if ($data['code'] == 200 && isset($data['data'])) {
                foreach ($data['data'] as $ward) {
                    Xaphuong::updateOrCreate(
                        ['xaid' => $ward['WardCode']],
                        [
                            'name' => $ward['WardName'],
                            'type' => $ward['NameExtension'][0] ?? '',
                            'maqh' => $district->maqh,
                            'xaid' => $ward['WardCode'],
                        ]
                    );
                }
                $this->info('Đã nhập thành công các xã phường cho quận huyện: ' . $district->name);
            } else {
                $this->error('Lỗi khi gọi API hoặc dữ liệu không hợp lệ cho quận huyện: ' . $district->name);
            }
        }
    }
}
