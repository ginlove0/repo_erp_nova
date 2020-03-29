<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherModelName extends DBModel
{
    protected $table = "other_model_name";

    protected $fillable = ["name", 'modelId'];

    public function ditmeloicailon(): BelongsTo
    {
        return $this->belongsTo(Model::class, 'modelId');
    }


}
