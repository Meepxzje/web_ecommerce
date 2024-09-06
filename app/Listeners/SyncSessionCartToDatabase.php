<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use App\Models\Giohang;
use App\Models\Chitietgiohang;
use Illuminate\Support\Facades\DB;

class SyncSessionCartToDatabase
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = Auth::user();
        $sessionGiohang = session()->get('giohang', []);

        if (!empty($sessionGiohang)) {
            $giohang = Giohang::firstOrCreate(['nguoidungid' => $user->id]);

            foreach ($sessionGiohang as $sanphamid => $details) {
                Chitietgiohang::updateOrCreate(
                    ['giohangid' => $giohang->id, 'sanphamid' => $sanphamid],
                    ['soluong' => DB::raw("soluong + {$details['soluong']}"), 'gia' => $details['gia']]
                );
            }

            // Clear the session cart
            session()->forget('giohang');
        }
    }
}
