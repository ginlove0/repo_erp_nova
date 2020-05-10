<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

//use Laravel\Scout\Searchable;

class Model extends DBModel
{
    protected $table = "model";


    use SoftDeletes;


    protected $fillable = ["addedBy", "manufactorId", "name",
        "hasSerial" , "shortDescription", "longDescription",
        "note" , "categoryId"];




    public function otherModelNames(): HasMany
    {
       return $this->hasMany(OtherModelName::class, 'modelId', "id");
    }

    public function manufactors(): BelongsTo
    {
        return $this->belongsTo(Manufactor::class, "manufactorId", "id");
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, "categoryId", "id");
    }

    public function listedModels(): BelongsTo
    {
        return $this->belongsTo(ListedModel::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, "modelId","id");
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class, "modelId", "id");
    }

    /**
     * Get all the model included in the sale order.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
//    public function saleordermodels(): HasMany
//    {
//        return $this->hasMany(SaleOrderModel::class, 'modelId');
//    }

    public function sale_order_item():HasMany
    {
        return $this->hasMany(SaleOrderItem::class,'modelId');
    }

//    public function saleordermodeltype()
//    {
//        return $this->morphMany(SaleOrderModelType::class, 'sale_model');
//    }


    public static function insertData($data){

        $value=DB::table('model')->where('name', $data['name'])->get();
        if($value->count() == 0){
            DB::table('model')->insert($data);
        }
    }



}
