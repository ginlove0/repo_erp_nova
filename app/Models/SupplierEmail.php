<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierEmail extends Model
{
    use SoftDeletes;


    protected $table = "supplier_email";
    protected $fillable  = ["email", "supplierId", "typeemail"];

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, "supplierId", "id");
    }

    public function saleorders(): HasMany
    {
        return $this->hasMany(SaleOrder::class, "supplierEmailId", "id");
    }


    /**
     * Get the supplier email define as supplier email associated with the sale order.
     * @return HasMany
     */
    public function supplierinvoiceemails(): HasMany
    {
        return $this->hasMany(SupplierEmail::class, 'supplierInvoiceEmailId', 'id');
    }



    /**
     * Get the supplier email define as supplier email associated with the sale order.
     * @return HasMany
     */
    public function suppliertrackingemails(): HasMany
    {
        return $this->hasMany(SupplierEmail::class, 'supplierTrackingEmailId', 'id');
    }

}