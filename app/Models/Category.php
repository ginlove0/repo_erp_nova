<?php


namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = "category";

    protected $fillable = ["name"];
    use SoftDeletes;

    public function models()
    {
        return $this->hasMany(\App\Models\Model::class, "categoryId", "id");
    }

}
