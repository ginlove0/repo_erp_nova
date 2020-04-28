<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class OldModel extends Model
{
    //
    protected $table = 'old_model';

    protected $fillable = [
        'name'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'old_model_id', 'id');
    }
}
