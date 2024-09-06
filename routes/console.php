<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('import:thanhpho', function () {
    $this->call(\App\Console\Commands\ImportThanhPho::class);
});

Artisan::command('order:update-status', function () {
    $this->call(\App\Console\Commands\UpdateOrderStatus::class);
})->purpose('Update order status from GHN API every 5 minutes')->hourly();



Schedule::command('giamgia:update-status')->everyMinute();
Schedule::command('notify:discounts')->everyMinute();
// Schedule::command('order:update-status');




