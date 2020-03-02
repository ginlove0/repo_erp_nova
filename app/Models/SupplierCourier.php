<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierCourier extends Model
{
    use SoftDeletes;

    protected $table = 'courier_supplier';
    protected $fillable  = ['courier', 'shippingAccount'];

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, "supplierId", "id");
    }
    //
}
