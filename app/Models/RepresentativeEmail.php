<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model as DBModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RepresentativeEmail extends DBModel
{

    protected $table = "representative_email";

    protected $fillable = ["email", "representativeId"];

    use SoftDeletes;

    public function representatives(): BelongsTo
    {
        return $this->belongsTo(Representative::class, "representativeId" , "id");
    }

}