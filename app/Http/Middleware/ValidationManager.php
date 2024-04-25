<?php

namespace App\Http\Middleware;

use App\Models\Permissions;
use App\Models\PermissionsName;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;


class ValidationManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $routeName = Route::currentRouteName();
        $userId = session()->get('user_id');
        $roleId = session()->get('role_id');


        if ($roleId != 1 && $roleId != 3) {
            $permissionCheck = PermissionsName::where('name', $routeName)->first();
            if ($permissionCheck) {
                $permissionId = $permissionCheck->id;

                $permission = permissions::where('permission_id', $permissionId)
                                         ->where('role_id', $roleId)
                                         ->first();

                if ($permission) {
                    return $next($request); 
                } else {
                    return redirect()->back()->with('error', 'You do not have permission to access this page');
                }
            }
        }

        return redirect()->back()->with('error', 'You do not have permission to access this page');
    }
}
