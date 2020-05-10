<?php
namespace Ipsupply\CheckoutItemResourceTool\Http\Controllers;

use App\Models\Item;
use App\Models\SaleOrderItem;
use App\Models\SaleOrderPackedItem;
use App\Services\SaleOrder\SaleOrderServiceInterface;
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
        return $this->saleOrderService->findItemBySaleOrderId($saleOrderId);
    }

    public function findItem($itemId, $saleorderId)
    {
        $item = Item::where('id', $itemId)->first();
        if($item){
            $item->stockStatus = true;
            $item->save();
        }

        $deleteItem = SaleOrderPackedItem::where('item_id',$itemId)->first();
        if($deleteItem)
        {
            $deleteItem->delete();
        }

        $saleorders = SaleOrderItem::where('sale_order_id', $saleorderId) -> get();
        foreach ($saleorders as $saleorder)
        {

            if($saleorder -> shipped > 0)
            {
                $saleorder -> qty = $saleorder -> qty + 1;
                $saleorder -> shipped = $saleorder -> shipped - 1;
                $saleorder -> save();
                return Action::message('Delete item '. $item->serialNumber . ' success');

            }

        }

    }
}
