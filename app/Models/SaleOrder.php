<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Fields\BelongsToMany;
use OptimistDigital\NovaNotesField\Traits\HasNotes;

class SaleOrder extends Model
{

    use HasNotes;
    protected $casts = [
        'saleordermodels' => 'array'
    ];

    protected $table = "sale_order";

    protected $fillable = [
        "supplierId", "representativeId", "billingAddressId",
        "shippingAddressId", "discount", "shipping_charge",
        "shipping_method", "sender_id", "supplierInvoiceEmailId",
        "supplierTrackingEmailId", "required_date",
        "linkEbay", "itemPackedId", "purchase_order_pdf",
        "attachment", "attachment_name", "attachment_size", "note"];

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
     * Get the supplier address define as billing address associated with the sale order.
     * @return BelongsTo
     */
    public function billingaddresses(): BelongsTo
    {
        return $this->belongsTo(SupplierAddress::class, 'billingAddressId', 'id');
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
    public function sale_order_item():HasMany
    {
        return $this->hasMany(SaleOrderItem::class,'sale_order_id');
    }


public function item():HasMany
{
    return $this->hasMany(Item::class, 'sale_order_id', 'id');
}




    /**
     * Get the sender included in the sale order.
     * @return BelongsTo
     */
    public function senders(): BelongsTo
    {
        return $this->belongsTo(Sender::class, "sender_id");
    }






}
