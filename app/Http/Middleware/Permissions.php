<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $module, $option)
    {
        $permissions=session()->get('permissions');
        if(Arr::has($permissions, $module)){
            if($option==0){
                if(in_array(1, $permissions[$module]['options']) || in_array(2, $permissions[$module]['options'])){
                    return $next($request);
                }
            }else{
                if(in_array($option, $permissions[$module]['options'])){
                    return $next($request);
                }
                return response()->json([
                    'authorize' => false,
                    'message' => 'Unauthorized action.'
                ]);
            }
        }
        return back();
    }
}
