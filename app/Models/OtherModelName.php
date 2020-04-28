<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtherModelName extends DBModel
{
    protected $table = "other_model_name";

    protected $fillable = ["name"];

    public function models()
    {
        return $this->belongsTo(\App\Models\Model::class, 'modelId');
    }


}
