<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        $auth_user = $this->findOrCreateUser($user, $provider);
        Auth::login($auth_user, true);
        return redirect('/');
    }

    public function findOrCreateUser($user, $provider)
    {
        $auth_user = User::where('provider_id', $user->id)->first();
        if ($auth_user) {
            return $auth_user;
        }
        else{
            $data = User::create([
                'name'     => $user->name,
                'email'    => !empty($user->email)? $user->email : '' ,
                'provider' => $provider,
                'provider_id' => $user->id
            ]);
            return $data;
        }
    }
}
