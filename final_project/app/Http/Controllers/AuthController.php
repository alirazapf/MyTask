<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use App\Mail\VerifyUserEmail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $verifyMailToken = Str::random(30);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'remember_token' => $verifyMailToken,
            ]);
            Mail::to($request->email)->send(new VerifyUserEmail($verifyMailToken));
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

             

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                    
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $token = $user->createToken('Token Name')->accessToken,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function logout(){
        
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        return response([
            'message' => 'User Logout Successfully !',
        ], 200);




    }
    public function verify($token){

        $user = User::where('remember_token', $token)->first();
        if (!is_null($user)) {
            if (!$user->email_verified) {
                $user->email_verify = true;
                $user->email_verified_at = now();
                $user->save();
                return redirect()->route('welcome');
            } else {
                return redirect()->route('welcome');
            }
        } else {
            return redirect()->route('non-verify');
        }
    }

    public  function resetPassword(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|string|min:5|confirmed',
            'password_confirmation' => 'required',
        ]);
        if (Auth::check()) {
            $user = Auth::user();
            $user->password = $request->password;
            $user->save;
            return response([
                'message' => 'Your Password Updated Successfully !',
            ], 200);
        }
    }

    public function forgetpassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(50);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);
        Mail::to($request->email)->send(new ForgetPasswordMail($token));
        return response([
            'message' => 'Please Check Your Email For Reset Your Password',
        ], 200);
    }

    public function resetForgetPassword(Request $request, $token)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:5|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = DB::table('password_resets')->where(['email' => $request->email, 'token' => $token])->first();
        if (!$updatePassword) {
            return redirect()->route('login');
        }
        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where('email', $request->email)->where('token', $token)->delete();
        return response([
            'message' => 'Your Password reset Successfully !',
        ], 200);
    }
}

