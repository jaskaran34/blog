<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use App\Models\SocialAccount;
use App\Models\User;
use \App\http\Resources\UserResource;

class GoogleController extends Controller
{
 public function redirectToGoogle()  {
    return Socialite::driver('google')->redirect();
    
 }
 public function handleGoogleCallback()
 {
    $googleUser = Socialite::driver('google')->user();

            // Check if the user exists or create one
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                ['name' => $googleUser->getName()]
            );

            // Create a social account entry
            SocialAccount::firstOrCreate([
                'user_id' => $user->id,
                'provider' => 'google',
                'provider_user_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar()
            ]);
  
            
            return view('redirect_to_frontend', [
                'url' => 'http://localhost:5173/handle-data', // Vue.js frontend URL
                'data' => [
                    'id' => $googleUser->getId()
                ],
            ]);

            /*
            return redirect()->away('http://127.0.0.1:3000/signin?' . http_build_query([
                'access_token' => $token,
                'user_name' => $user->name,
                'user_email' => $user->email,
                'image' => $imageData,
            ]));

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user),
            'image' => $imageData
        ], 201);

        */
    }
}
