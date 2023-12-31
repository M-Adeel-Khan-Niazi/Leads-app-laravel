<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            $allowedRoutes = ['leads', 'logout'];
            $isAllowed = count(array_intersect($allowedRoutes, $request->segments()));
            if ($user && $user->role == 'agent' && !$isAllowed) {
                abort(403);
            }
            return $next($request);
        });
    }
}
