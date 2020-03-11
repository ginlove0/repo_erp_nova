<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EbayModel extends Model
{
    //
    protected $table= 'model_ebay';

    protected $fillable =['name', 'shortDescription', 'longDescription', 'note'];

    public function saleordermodeltype()
    {
        return $this->morphMany(SaleOrderModelType::class, 'sale_model');
    }
}
