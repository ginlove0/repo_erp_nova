<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SaleOrderModelType extends Model
{
    //
    protected $table = 'sale_order_model_type';

    protected $fillable = ['sale_model_type', 'sale_model_id', 'sale_order_id', 'conditionId', 'qty', 'price', 'note'];

    public function sale_model(): MorphTo
    {
        return $this -> morphTo();
    }


    public function saleorder(): BelongsTo
    {
        return $this->belongsTo(SaleOrder::class, 'sale_order_id', 'id');
    }

    public function condition(): BelongsTo
    {
        return $this->belongsTo(Condition::class, 'conditionId', 'id');
    }
}
