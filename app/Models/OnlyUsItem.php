<?php

namespace App\Models;

use App\Models\Condition;
use App\Models\OldModel;
use App\Models\SaleOrder;
use App\Models\Supplier;
use App\Models\WHLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class

OnlyUsItem extends Model
{
    //

    use SoftDeletes;

    protected $table = "item";

    protected $fillable = ["addedBy", "whlocationId", "supplierId",
        "modelId", "serialNumber", "price",
        "note", "extra", "quantity", "conditionId", "stockStatus",
        "location", "smartnet", "version", "sale_order_id", "old_model_id",
        "created_at", "updated_at", "test_report"];



    public function whlocations() : BelongsTo
    {
        return $this->belongsTo(WHLocation::class, "whlocationId", "id");
    }


    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, "supplierId", "id");
    }

    public function models() : BelongsTo
    {
        return $this->belongsTo(OnlyUsModel::class, "modelId", "id");
    }


    public function conditions(): BelongsTo
    {
        return $this->belongsTo(Condition::class,  "conditionId", "id");
    }

    public function old_models(): BelongsTo
    {
        return $this->belongsTo(OldModel::class, 'old_model_id', 'id');
    }
}
