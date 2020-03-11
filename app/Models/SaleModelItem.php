<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleModelItem extends Model
{

    protected $table = "sale_model_item";
    protected $fillable = ['sn_out_of_stock', 'sale_order_model_id', 'sn_display_client'];


//    public function

    public function saleordermodels(): BelongsTo
    {
        return $this->belongsTo(SaleOrderModelType::class, 'sale_order_model_id');
    }
}
