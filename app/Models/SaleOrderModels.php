<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SaleOrderModels extends Model
{
    protected $casts = [
        'saleordermodels' => 'array'
    ];

    protected $table = 'sale_order_model';

    protected $fillable = ["modelId", "sale_order_id", "conditionId",
        "qty", "price", "note"];


    /**
     * Get all the model associated with the sale order.
     * @return BelongsTo
     */
    public function models(): BelongsTo
    {
       return $this->belongsTo(\App\Models\Model::class, 'modelId', 'id');
    }


    /**
     * Get the sale order info associated with the models.
     * @return BelongsTo
     */
    public function saleorder(): BelongsTo
    {
       return $this->belongsTo(SaleOrder::class, 'sale_order_id', 'id');
    }



    /**
     * Get the condition of the model.
     * @return BelongsTo
     */
    public function condition(): BelongsTo
    {
       return $this->belongsTo(Condition::class, 'conditionId', 'id');
    }

}
