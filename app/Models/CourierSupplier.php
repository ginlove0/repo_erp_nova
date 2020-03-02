<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourierSupplier extends Model
{
    protected $table = "courier_supplier";
    protected $fillable= ["supplierId", "courier", "shippingAccount"];

    use SoftDeletes;


    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, "supplierId", "id");
    }

}