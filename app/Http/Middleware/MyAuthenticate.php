<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class MyAuthenticate
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(!empty($request) && !empty($request->token)){
          $userObj = User::Where("remember_token",$request->token)->first();
          if(!empty($userObj))
            return $next($request);
          else
            return response("Unauthorize User!", 201);
      }else {
        return response("Unauthorize User!", 201);
      }

        //return $next($request);
    }

}

 ?>
