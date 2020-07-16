<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($service){
        try {
            return Socialite::driver($service)->redirect();
        } catch (\Exception $e) {
            return redirect()->to('login');
        }
    }

    public function callback($service){
        $user = Socialite::with($service)->stateless()->user();
        return response()->json($user);
    }
}
