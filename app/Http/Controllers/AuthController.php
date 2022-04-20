<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function RedirectAzure()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function AuthenticateAzure()
    {
        $azureUser = Socialite::driver('microsoft')->user();

        $user = User::updateOrCreate([
            'azure_id' => $azureUser->id,
        ], [
            'name' => $azureUser->name,
            'email' => $azureUser->email,
            'azure_token' => $azureUser->token,
            'password' => Hash::make(Str::random(40)),
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
