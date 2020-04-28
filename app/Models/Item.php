<?php


namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Item extends Model
{



    use SoftDeletes;

    protected $table = "item";

    protected $fillable = ["addedBy", "whlocationId", "supplierId",
        "modelId", "serialNumber", "price",
        "note", "extra", "quantity", "conditionId", "stockStatus",
        "location", "smartnet", "version", "sale_order_id", "old_model_id", "created_at"];


    public function saleorder(): BelongsTo
    {
        return $this->belongsTo(SaleOrder::class, 'sale_order_id', 'id');
    }

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
        return $this->belongsTo(\App\Models\Model::class, "modelId", "id");
    }


    public function conditions(): BelongsTo
    {
        return $this->belongsTo(Condition::class,  "conditionId", "id");
    }

    public function old_models(): BelongsTo
    {
        return $this->belongsTo(OldModel::class, 'old_model_id', 'id');
    }

    public static function insertData($data){

        $value=DB::table('item')->where('serialNumber', $data['serialNumber'])->get();
        if($value->count() == 0){
            DB::table('item')->insert($data);
        }
    }
}
