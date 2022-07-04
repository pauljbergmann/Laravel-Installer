<?php

namespace Pauljbergmann\LaravelInstaller\Middleware;

use Closure;
use DB;
use Illuminate\Http\Request;
use Pauljbergmann\LaravelInstaller\Helpers\InstalledFileManager;

class CanInstall
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (InstalledFileManager::alreadyInstalled()) {
            abort(404);
        }

        return $next($request);
    }
}
