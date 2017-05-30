<?php 
namespace App\Http\Middleware;

use Closure, Auth;

class CheckAdmin
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user) {
            $role = config('allelua.roles');
            if ($user->role_id != $role['administrator']) {
              return redirect()->route('home');
            }
        }

        return $next($request);
    }

}