<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;


    protected $table = 'supplier';

    protected $fillable = ['name','contactType',
        'pricingLevel', 'ipsPolicy',
        'warrantyPolicy', 'ipsTerm',
        'customerTerm', 'VAT',
        'noteShipping', 'noteReceiving'];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, "supplierId", "id");
    }

    public function representatives(): HasMany
    {
        return $this->hasMany(Representative::class, "supplierId", "id");
    }

    public function supplieremails(): HasMany
    {
        return $this->hasMany(SupplierEmail::class, "supplierId", "id");
    }
//    public function
    public function supplieraddresses(): HasMany
    {
        return $this->hasMany(SupplierAddress::class, "supplierId", "id");
    }

    public function suppliernotes(): HasMany
    {
        return $this->hasMany(SupplierNote::class,"supplierId", "id");
    }

    public function supplierpayments(): HasMany
    {
        return $this->hasMany(SupplierPayment::class,"supplierId", "id");
    }

    public function couriersuppliers(): HasMany
    {
        return $this->hasMany(CourierSupplier::class, "supplierId", "id");
    }

    public function saleorders(): HasMany
    {
        return $this->hasMany(SaleOrder::class, 'supplierId');
    }





}
