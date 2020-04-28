<?php

namespace Ipsupply\ItemTransferResourceTool\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class WhTransferController extends Controller
{
    public function index($products)
    {
        Log::info($products);
    }
}
