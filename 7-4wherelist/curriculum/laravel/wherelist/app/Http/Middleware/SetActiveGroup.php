<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Group;

class SetActiveGroup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('active_group_id')) {
            $groupId = session('active_group_id');
            $group = Group::with('users')->find($groupId);
            view()->share('activeGroup', $group);
        }

        return $next($request);
    }
}
