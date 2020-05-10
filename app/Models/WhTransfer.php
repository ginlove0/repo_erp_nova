<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OptimistDigital\NovaNotesField\Traits\HasNotes;

class WhTransfer extends Model
{
    use HasNotes;
    //
    protected $table='wh_transfer';

    protected $fillable=['trackNumber', 'trackingCourier', 'createdBy', 'whTransferLocationId', 'created_at', 'expect_ship_in', 'status'];
    protected $casts = ['expect_ship_in' => 'date'];

    public function whtransferlocation():BelongsTo
    {
        return $this->belongsTo(WhTransferLocation::class,'whTransferLocationId', 'id');
    }

    public function whtransfermodel():HasMany
    {
        return $this->hasMany(WhTransferModel::class, 'whTransferId','id');
    }
}
