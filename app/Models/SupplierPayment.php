<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplierPayment extends Model
{
    protected $table = "paymentsupplier";

    protected $fillable = ["supplierId",	"currency",	"bankName",	"bankBranch",	"BSB",	"accountName",	"accountNumber",	"paypal"	];

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, "supplierId", 'id');
    }
}