<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListedModel extends Model
{
    protected $table = "listed_model";

    use SoftDeletes;

    public function models(): HasMany
    {
        return $this->hasMany(\App\Models\Model::class);
    }

    public function conditions(): HasMany
    {
        return $this->hasMany(Condition::class);
    }
}
