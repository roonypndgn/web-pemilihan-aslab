<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (empty($roles)) {
            return $next($request);
        }

        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        $redirectRoutes = [
            'kepala_lab' => route('kepalalab.dashboard'),
            'penguji' => route('penguji.dashboard'),
            'calon_aslab' => route('calonaslab.dashboard'),
        ];

        if (isset($redirectRoutes[$user->role])) {
            return redirect($redirectRoutes[$user->role])
                ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }

        Auth::logout();
        return redirect()->route('login')
            ->with('error', 'Role tidak dikenali. Silakan login kembali.');
    }
}