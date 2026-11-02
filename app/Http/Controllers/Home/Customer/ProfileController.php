<?php

namespace App\Http\Controllers\Home\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('app.profile.profile');
    }

    public function showAddresses()
    {
        return view('app.addresses');
    }

    public function storeAddress()
    {
        // $inputs = 
    }
}
