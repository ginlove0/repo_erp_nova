<?php


namespace app\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WHLocation extends Model
{

    use SoftDeletes;

    protected $table = 'whlocation';

    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }


    public function saleorders(): HasMany
    {
        return $this->hasMany(SaleOrder::class, 'whlocation_id');
    }


}
