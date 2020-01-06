<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\User;

class ProfileService
{
    /**
     * Updates User Contact Information
     *
     * @param array $data
     */
    public function updateInformation(array $data)
    {
        Auth::user()->name = $data['name'];
        Auth::user()->email = $data['email'];
        Auth::user()->profile->first_name = $data['first_name'];
        Auth::user()->profile->last_name = $data['last_name'];
        Auth::user()->profile->address = $data['address'];
        Auth::user()->profile->city = $data['city'];
        Auth::user()->profile->country = $data['country'];
        Auth::user()->profile->post_code = $data['post_code'];
        Auth::user()->profile->phone_number = $data['phone_number'];
        Auth::user()->profile->save();
        Auth::user()->save();
    }

    /**
     * Updates user password
     *
     * @param string $password
     */
    public function updatePassword(string $password)
    {
        Auth::user()->password = bcrypt($password);
        Auth::user()->save();
    }

    /**
     * Deletes User Account
     */
    public function deleteAccount()
    {
        Auth::user()->delete();
    }

}