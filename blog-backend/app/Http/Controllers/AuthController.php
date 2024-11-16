<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use \App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

use Intervention\Image\ImageManagerStatic as Image;
use \App\Models\Profile;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \App\http\Resources\UserResource;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
   
    public function profile(){
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        return new UserResource($user);
    }
    public function register(Request $request)
    {
        
   
            
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $file = $request->file('image'); 
        $image = Image::make($file->getRealPath());

        
        $image->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio(); // Maintain the aspect ratio
            $constraint->upsize();      // Prevent resizing larger images
        });

        $image->encode('jpg', 95); 

        $file_path='images/profile/' . time().$file->getClientOriginalName();
        $compressedPath = storage_path($file_path);
        $image->save($compressedPath);

        

        // Create new user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Profile::create([
            'user_id'=>$user->id,
            'path'=> $file_path
        ]);



        //return gettype($user);
        // Generate token
        $token = $user->createToken('Api token of '.$user->name)->plainTextToken;
        //$token = $user->createToken('auth_token')->plainTextToken;

       

        $imageData = base64_encode(file_get_contents($compressedPath));

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user),
            'image' => $imageData
        ], 201);

    
    }

    // Login method
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        //return gettype($user);

       // $user->tokens()->delete();

        // Generate token
        //$token = $user->createToken('auth_token')->plainTextToken;
        $token = $user->createToken('Api token of '.$user->name)->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user)
        ]);
    }

    // Logout method
    public function logout(Request $request)
    {
        //return $headers = $request->headers->all();
        
        // Revoke the user's current token
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
        
    }

    function profile_update(UpdateUserRequest $request){
        
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $user->name = $request->name;
        $user->save();
        return new UserResource($user);
    }

    public function logout_all(Request $request){
        $user = Auth::user();

        //return gettype($user);

       $user->tokens()->delete();

       return response()->json(['message' => 'Logged out successfully of all logins']);
    }




    //end class
}
