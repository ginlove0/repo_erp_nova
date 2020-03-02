<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sender extends Model
{
    use SoftDeletes;

    protected $table = 'sender';

    protected $fillable = ["company", "phoneNumber", "ceo",	"address"];

    public function saleorders(): HasMany
    {
        return $this->hasMany(SaleOrder::class,"sender_id");
    }

    
}