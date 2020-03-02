<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Representative extends DBModel
{
    use SoftDeletes;

    protected $table = "representative";

    protected $fillable = ['supplierId', 'salutation','fullName', 'position', 'phoneNumber'];

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, "supplierId", "id");
    }

    public function representativeemails(): HasMany
    {
        return $this->hasMany(RepresentativeEmail::class, 'representativeId', 'id');
    }

    public function saleorders(): HasMany
    {
        return $this->hasMany(SaleOrder::class, "representativeId", "id");
    }

}