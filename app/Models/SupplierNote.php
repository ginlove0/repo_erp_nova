<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierNote extends Model
{

    use SoftDeletes;

    protected $table = "suppliernote";

    protected $fillable = [ "internalNote", "supplierId", "created_at"];


//    public function getCreatedAtAttribute($date)
////    {
////        return \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y - H:i:s');
////    }

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, "supplierId", "id");
    }

}
