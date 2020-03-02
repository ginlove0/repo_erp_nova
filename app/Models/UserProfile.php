<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    protected $table = "user_profile";

    protected $fillable = ["usersId","name","dob",
    "address","city",	"state","postcode",
    "phoneNumber","emergencyContactName"	,
    "emergencyContactPhoneNumber",	"bankName",
        "bankBranch","BSB",	"accountName",	"accountNumber",
            "fundName",	"fundNumber",	"usi",	
            "accountSuperName",	"membershipNumber",	"tfn"];

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class, "usersId", 'id');
    }
}