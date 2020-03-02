<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Manufactor extends Model
{
    protected $table = "manufactor";

    protected $fillable = ['name'];

    public function models()
    {
        return $this->hasMany(\App\Models\Model::class,"manufactorId", "id");
    }
}
