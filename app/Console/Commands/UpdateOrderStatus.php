<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\GHNController;

class UpdateOrderStatus extends Command
{
    protected $signature = 'order:update-status';

    protected $description = 'Update order status from GHN API every 5 minutes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new GHNController();
        $controller->capnhattrangthai();
    }
}
