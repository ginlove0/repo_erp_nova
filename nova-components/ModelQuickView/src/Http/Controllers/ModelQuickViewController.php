<?php

namespace Ipsupply\ModelQuickView\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ModelQuickViewController extends \Illuminate\Routing\Controller
{

    public function getDetail()
    {

        $data = DB::select("
            select sum(quantity) as QTY, model.name as Model, item.updated_at as Date, supplier.name as Supp, whlocation.name as Location, backup.name as Con
            from ((((item
            inner join model on item.modelId = model.id)
                    inner join supplier on item.supplierId = supplier.id)
      		                inner join whlocation on item.whlocationId = whlocation.id)
      		                            inner join backup on item.conditionId = backup.id)
      		where DATE(item.updated_at) >= DATE_SUB(DATE(CURRENT_TIMESTAMP ), INTERVAL 7 DAY)
  			and DATE(item.updated_at)  <= DATE(CURRENT_TIMESTAMP )
  			and item.stockStatus = true
            group by DATE(item.updated_at) DESC, item.supplierId, item.whlocationId, item.conditionId
        ");

        return $data;
    }

    public function getDetailInADay()
    {
        $data = DB::select("
            select sum(quantity) as QTY, model.name as Model, item.updated_at as Date, supplier.name as Supp, whlocation.name as Location, backup.name as Con
            from ((((item
            inner join model on item.modelId = model.id)
                    inner join supplier on item.supplierId = supplier.id)
      		                inner join whlocation on item.whlocationId = whlocation.id)
      		                            inner join backup on item.conditionId = backup.id)
      		where DATE(item.updated_at) >= CAST(CURRENT_TIMESTAMP as DATE)
      		and item.stockStatus = true
            group by DATE(item.updated_at) DESC, item.supplierId, item.whlocationId, item.conditionId
        ");

        return $data;
    }

    public function getDetailIn2Day()
    {
        $data = DB::select("
            select sum(quantity) as QTY, model.name as Model, item.updated_at as Date, supplier.name as Supp, whlocation.name as Location, backup.name as Con
            from ((((item
            inner join model on item.modelId = model.id)
                    inner join supplier on item.supplierId = supplier.id)
      		                inner join whlocation on item.whlocationId = whlocation.id)
      		                            inner join backup on item.conditionId = backup.id)
      		where DATE(item.updated_at) >= DATE_SUB(DATE(CURRENT_TIMESTAMP), INTERVAL 1 DAY)
      		and item.stockStatus = true
            group by DATE(item.updated_at) DESC, item.supplierId, item.whlocationId, item.conditionId
        ");

        return $data;
    }

    public function getOutStockInADay()
    {
        $data = DB::select("
            select sum(quantity) as QTY, model.name as Model, item.updated_at as Date, supplier.name as Supp, whlocation.name as Location, backup.name as Con
            from ((((item
            inner join model on item.modelId = model.id)
                    inner join supplier on item.supplierId = supplier.id)
      		                inner join whlocation on item.whlocationId = whlocation.id)
      		                            inner join backup on item.conditionId = backup.id)
      		where DATE(item.updated_at) >= CAST(CURRENT_TIMESTAMP as DATE)
      		and item.stockStatus = false
            group by DATE(item.updated_at) DESC, item.supplierId, item.whlocationId, item.conditionId
        ");

        return $data;
    }
}
