<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierAddress extends Model
{

    use SoftDeletes;

    protected $table = "supplieraddress";

    protected $fillable = ['supplierId','country', 'postcode', 'city',
    'state', 'street', 'type'];

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, "supplierId", "id");
    }
//
    public function billingaddresses(): HasMany
    {
        return $this->hasMany(SaleOrder::class, "billingAddressId", 'id');
    }

    public function shippingaddresses(): HasMany
    {
        return $this->hasMany(SaleOrder::class, "shippingAddressId", 'id');
    }
}