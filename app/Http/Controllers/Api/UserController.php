<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    /**
     * reister new user and generte token
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function register(Request $request)
     {
         $data = $request->validate([
             'name' => 'required|string',
             'email' => 'required|string|email|unique:users',
             'password' => 'required|string|min:8|confirmed',
         ]);
        try{
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);
            $token = auth('api')->login($user);
            return $this->respondWithToken($token);
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Failed to create product: ' . $e->getMessage(),
            ], 500);
        }
 
     }
 
     /**
      * Get a JWT via given credentials.
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function login()
     {
         $credentials = request(['email', 'password']);
 
         if (! $token = auth('api')->attempt($credentials)) {
             return response()->json(['error' => 'Unauthorized Access'], 401);
         }
 
         return $this->respondWithToken($token);
     }
 
     /**
      * Get the User profile.
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function me()
     {
         return response()->json(auth('api')->user());
     }
 
     /**
      * Log the user out.
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function logout()
     {
         auth('api')->logout();
 
         return response()->json(['message' => 'Successfully logged out']);
     }
 
     /**
      * Refresh a token.
      *
      * @return \Illuminate\Http\JsonResponse
      */
     public function refresh()
     {
         return $this->respondWithToken(auth()->refresh());
     }
 
     /**
      * Get the token array structure.
      *
      * @param  string $token
      *
      * @return \Illuminate\Http\JsonResponse
      */
     protected function respondWithToken($token)
     {
         return response()->json([
             'access_token' => $token,
             'token_type' => 'bearer',
             'expires_in' => auth('api')->factory()->getTTL() * 60
         ]);
     }
}
