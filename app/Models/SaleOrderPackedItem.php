<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleOrderPackedItem extends Model
{
    //
    protected $table='sale_order_item';

    protected $fillable=['sale_order_id', 'item_id', 'modelId', 'conditionId', 'whlocationId'];

    public function saleorder():BelongsTo
    {
        return $this->belongsTo(SaleOrder::class,'sale_order_id', 'id');
    }

    public function items():BelongsTo
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function models():BelongsTo
    {
        return $this -> belongsTo(\App\Models\Model::class, 'modelId', 'id');
    }

    public function conditions():BelongsTo
    {
        return $this->belongsTo(Condition::class,'conditionId', 'id');
    }

    public function whlocation():BelongsTo
    {
        return $this->belongsTo(WHLocation::class,'whlocationId', 'id');
    }
}
