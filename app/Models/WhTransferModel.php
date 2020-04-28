<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WhTransferModel extends Model
{
    //
    protected $table='wh_transfer_model';

    protected $fillable=['modelId', 'conditionId', 'qty', 'note', 'whTransferId'];

    public function models():BelongsTo
    {
        return $this->belongsTo(\App\Models\Model::class,'modelId', 'id');
    }

    public function conditions():BelongsTo
    {
        return $this->belongsTo(\App\Models\Condition::class,'conditionId','id');
    }

    public function whtransfer(): BelongsTo
    {
        return $this->belongsTo(WhTransfer::class, 'whTransferId', 'id');
    }
}
