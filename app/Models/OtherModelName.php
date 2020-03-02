<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherModelName extends Model
{
    protected $table = "other_model_name";

    protected $fillable = ["name", 'modelId'];

    public function models()
    {
        return $this->belongsTo(\App\Models\Model::class, 'modelId');
    }


}
