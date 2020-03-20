<?php


namespace App\Models;

use App\Nova\SaleOrderModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Nova\Fields\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SaleOrder extends Model
{

    protected $casts = [
        'saleordermodels' => 'array'
    ];

    protected $table = "sale_order";

    protected $fillable = ["supplierId", "representativeId",
        "supplierEmailId",	"billingAddressId",
        "shippingAddressId",	"shippingMethod",
        "discount", "shipping_charge",
        "shipping_method", "sender_id", "supplierInvoiceEmailId",
        "supplierTrackingEmailId", "required_date", "whlocation_id", "linkEbay", "itemPackedId"];

    use SoftDeletes;

    /**
     * Get the supplier associated with the sale order.
     * @return BelongsTo
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplierId', 'id');
    }




    /**
     * Get the representative associated with the sale order.
     * @return BelongsTo
     */
    public function representatives(): BelongsTo
    {
        return $this->belongsTo(Representative::class, 'representativeId', 'id');
    }


    /**
     * Get the supplier email associated with the sale order.
     * @return BelongsTo
     */
    public function supplieremails(): BelongsTo
    {
        return $this->belongsTo(SupplierEmail::class,'supplierEmailId', 'id');
    }

    /**
     * Get the supplier address define as billing address associated with the sale order.
     * @return BelongsTo
     */
    public function billingaddresses(): BelongsTo
    {
        return $this->belongsTo('App\Models\SupplierAddress', 'billingAddressId', 'id');
    }


    /**
     * Get the supplier address define as shipping address associated with the sale order.
     * @return BelongsTo
     */
    public function shippingaddresses(): BelongsTo
    {
        return $this->belongsTo(SupplierAddress::class, 'shippingAddressId', 'id');
    }



    /**
     * Get the supplier email define as supplier email associated with the sale order.
     * @return BelongsTo
     */
    public function supplierinvoiceemails(): BelongsTo
    {
        return $this->belongsTo(SupplierEmail::class, 'supplierInvoiceEmailId', 'id');
    }



    /**
     * Get the supplier email define as supplier email associated with the sale order.
     * @return BelongsTo
     */
    public function suppliertrackingemails(): BelongsTo
    {
        return $this->belongsTo(SupplierEmail::class, 'supplierTrackingEmailId', 'id');
    }






    /**
     * Get all the model included in the sale order.
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
//    public function saleordermodels(): HasMany
//    {
//       return $this->hasMany(SaleOrderModels::class, "sale_order_id");
//    }

public function saleordermodeltype(): HasMany
{
    return $this->hasMany(SaleOrderModelType::class);
}

public function item():HasMany
{
    return $this->hasMany(Item::class);
}




    /**
     * Get the sender included in the sale order.
     * @return BelongsTo
     */
    public function senders(): BelongsTo
    {
        return $this->belongsTo(Sender::class, "sender_id");
    }

    /**
     * Get the warehouse location of the sale order.
     * @return BelongsTo
     */
    public function whlocations() : BelongsTo
    {
        return $this->belongsTo(WHLocation::class, "whlocation_id", "id");
    }




}
