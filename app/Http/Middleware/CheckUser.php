<?php 
namespace App\Http\Middleware;

use Closure, Auth;

class CheckUser
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
            if ($user->role_id != $role['user']) {
              return redirect()->route('home');
            }
        }

        return $next($request);
    }

}