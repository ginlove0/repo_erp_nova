<?php

namespace Ipsupply\ModelQuickView\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ModelQuickViewController extends \Illuminate\Routing\Controller
{

    public function getDetail()
    {

        $data = DB::select("
            select sum(quantity) as QTY, model.name as Model, item.created_at as Date, supplier.name as Supp, whlocation.name as Location, backup.name as Con
            from ((((item
            inner join model on item.modelId = model.id)
                    inner join supplier on item.supplierId = supplier.id)
      		                inner join whlocation on item.whlocationId = whlocation.id)
      		                            inner join backup on item.conditionId = backup.id)
      		where item.created_at >= DATE_SUB(now(), INTERVAL 7 DAY)  
  			and item.created_at  < now()
            group by CAST(item.created_at AS DATE) DESC, item.supplierId, item.whlocationId, item.conditionId
        ");

        return $data;
    }

    public function getDetailInADay()
    {
        $data = DB::select("
            select sum(quantity) as QTY, model.name as Model, item.created_at as Date, supplier.name as Supp, whlocation.name as Location, backup.name as Con
            from ((((item
            inner join model on item.modelId = model.id)
                    inner join supplier on item.supplierId = supplier.id)
      		                inner join whlocation on item.whlocationId = whlocation.id)
      		                            inner join backup on item.conditionId = backup.id)
      		where item.created_at >= DATE_SUB(now(), INTERVAL 1 DAY) 
            group by CAST(item.created_at AS DATE) DESC, item.supplierId, item.whlocationId, item.conditionId
        ");

        return $data;
    }
}
