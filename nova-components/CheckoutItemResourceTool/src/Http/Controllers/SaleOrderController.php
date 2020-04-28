<?php
namespace Ipsupply\CheckoutItemResourceTool\Http\Controllers;

use App\Models\Item;
use App\Models\SaleOrder;
use App\Models\SaleOrderModelType;
use App\Services\SaleOrder\SaleOrderServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Actions\Action;

class SaleOrderController extends Controller
{

         private $saleOrderService;
        public function __construct(SaleOrderServiceInterface $saleOrderService)
        {
            $this->saleOrderService  = $saleOrderService;
        }


    public function index($id)
        {
            return $this->saleOrderService->findSaleOrderModels($id);
        }

    public function show($saleOrderId)
    {
        return $this->saleOrderService->findItemsBySaleOrder($saleOrderId);
    }

    public function findItem($itemId, $saleorderId)
    {
        $item = Item::where('id', $itemId)->first();
        if($item){
            $item->sale_order_id = null;
            $item->stockStatus = true;
            $item->save();
        }

        $saleorders = SaleOrderModelType::where('sale_order_id', $saleorderId) -> get();
        foreach ($saleorders as $saleorder)
        {
            Log::info($saleorder);
            if($saleorder -> shipped > 0)
            {
                $saleorder -> qty = $saleorder -> qty + 1;
                $saleorder -> shipped = $saleorder -> shipped - 1;
                $saleorder -> save();
                return Action::message('Delete item '. $item->serialNumber . ' sucessful');

            }

        }

    }
}
