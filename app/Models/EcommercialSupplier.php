<?php


namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class EcommercialSupplier extends Model
{
    use SoftDeletes;

    protected $table = "ecommercial_supplier";

    protected $fillable = ["supplierId",	"identify",	"name"];

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, "supplierId", "id");
    }
}