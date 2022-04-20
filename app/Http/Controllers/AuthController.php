<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

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
            'azure_refresh_token' => $azureUser->refreshToken,
            'password' => 'test',
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
