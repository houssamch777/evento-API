<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $fields=$request->validate([
            
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15|unique:users',
            'location' => 'required|string|max:255',
            'date_of_birth' => 'required|date_format:Y',
            'gender' => 'required|in:male,female',
            'email'=>'required|email|unique:users',
            'password'=>'required|confirmed',
        ]);
        $fields['name'] = "{$fields['first_name']} {$fields['last_name']}";
        $user=User::create($fields);
        $token = $user->createToken($user->id);

        return [
            'user'=> $user,
            'profile_picture_url' => asset('storage/' . $user->profile_picture),
            'token'=>$token->plainTextToken,
        ];
    }


    public function login(Request $request){
        
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required',
        ]);

        $user=User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return[
                'message'=>'The provided email or password are incorrect',
            ];
        }
        $token = $user->createToken($user->id);

        return [
            'user'=> $user,
            'profile_picture_url' => asset('storage/' . $user->profile_picture),
            'token'=>$token->plainTextToken,
        ];
    }
    public function logout(Request $request){

        $request->user()->tokens()->delete();

        return ['message'=>'You are logged out.'];
    }
}
