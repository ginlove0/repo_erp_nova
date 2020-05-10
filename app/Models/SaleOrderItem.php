<?php

namespace App\Models;

use App\Models\Condition;
use App\Models\SaleOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleOrderItem extends Model
{
    //

    protected $table='sale_order_model';

    protected $fillable=['modelId', 'sale_order_id', 'conditionId', 'qty', 'price', 'note', 'shipped'];

    public function models():BelongsTo
    {
        return $this->belongsTo(\App\Models\Model::class, 'modelId', 'id');
    }

    public function conditions(): BelongsTo
    {
        return $this->belongsTo(Condition::class, 'conditionId', 'id');
    }

    public function sale_order():BelongsTo
    {
        return $this->belongsTo(SaleOrder::class, 'sale_order_id', 'id' );
    }
}
