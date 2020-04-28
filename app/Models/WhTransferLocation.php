<?php

namespace App\Models;

use App\Models\WhTransfer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WhTransferLocation extends Model
{
    //
    protected $table = 'wh_transfer_location';

    protected $fillable=['name'];

    public function whtransfer(): HasMany
    {
        return $this->hasMany(WhTransfer::class,'whTransferLocationId');
    }
}
