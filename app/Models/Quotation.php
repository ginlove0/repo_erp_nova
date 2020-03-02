<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends  Model
{
    protected $table = "quotation";

    protected $fillable = ["version", "supplierId",
        "conditionId", "smartnet",
        "currency", "cost",
        "validate_from", "validate_to",
        "note", "modelId", "quotationNumber"];

    use SoftDeletes;

    public function models(): BelongsTo
    {
//        make a one to many (model has many quotation) relationship
          return $this->belongsTo(\App\Models\Model::class, 'modelId', 'id');
    }

    public function suppliers(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplierId', 'id');
    }

    public function conditions(): BelongsTo
    {
        return $this->belongsTo(Condition::class, 'conditionId', 'id');
    }
}