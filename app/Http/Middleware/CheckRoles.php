<?php

namespace App\Http\Middleware;

use App\RoleModel;
use Closure;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        $user =  $request->user();
        $role = RoleModel::find($user->id_role);
        $roles = explode('|', $roles);

        if (!in_array($role->name, $roles)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return $next($request);
    }
}
