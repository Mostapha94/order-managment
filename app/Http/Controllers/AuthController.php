<?php
namespace App\Http\Controllers;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function register(RegisterRequest $req){
        $u = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);
        $token = auth()->login($u);
        return response()->json(['user'=>$u,'token'=>$token], 201);
    }
    public function login(LoginRequest $req){
        $credentials = $req->only('email','password');
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error'=>'Invalid credentials'], 401);
        }
        return response()->json(['token'=>$token]);
    }
}
