<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login (Request $request) {
      $validator = Validator::make($request->all(), [
          'email' => 'required|string|email|max:255',
          'password' => 'required|string',
      ]);
      if ($validator->fails())
      {
          return response(['errors'=>$validator->errors()->all()], 422);
      }
      $user = User::where('email', $request->email)->first();
      if ($user) {
          if (Hash::check($request->password, $user->password)) {
              $token = $user->remember_token;
              $response = ['token' => $token];
              return response($response, 200);
          } else {
              $response = ["message" => "Password mismatch"];
              return response($response, 422);
          }
      } else {
          $response = ["message" =>'User does not exist'];
          return response($response, 422);
      }
  }

  public function logout (Request $request) {
      $token = $request->user()->token();
      $token->revoke();
      $response = ['message' => 'You have been successfully logged out!'];
      return response($response, 200);
  }
}
