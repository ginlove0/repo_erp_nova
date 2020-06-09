<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Item;
use App\Models\ListedModel;
use App\Models\Manufactor;
use App\Models\OtherModelName;
use App\Models\Quotation;
use App\Models\SaleOrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlyUsModel extends Model
{
    //

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


    public function items(): HasMany
    {
        return $this->hasMany(OnlyUsItem::class, "modelId","id");
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class, "modelId", "id");
    }

}
