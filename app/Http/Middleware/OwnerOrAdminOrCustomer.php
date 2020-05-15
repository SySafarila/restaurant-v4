<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OwnerOrAdminOrCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $customer = Auth::user()->level == 'Customer';
        $admin = Auth::user()->level == 'Admin';
        $owner = Auth::user()->level == 'Owner';
        if ($owner or $admin or $customer) {
            return $next($request);
        }
        abort(404);
    }
}
