<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'city',
        'country', 
        'post_code', 
        'phone_number'
    ];
    /**
    * Get the user that owns the profile.
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
