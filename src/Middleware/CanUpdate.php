<?php

namespace Pauljbergmann\LaravelInstaller\Middleware;

use Closure;
use Illuminate\Http\Request;
use Pauljbergmann\LaravelInstaller\Helpers\InstalledFileManager;
use Pauljbergmann\LaravelInstaller\Helpers\MigrationsHelper;

class CanUpdate
{
    use MigrationsHelper;

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // If the application has not been installed yet,
        // we redirect to the user to the installer.
        if (! InstalledFileManager::alreadyInstalled()) {
            return redirect()->route('LaravelInstaller::welcome');
        }

        if ($this->alreadyUpdated()) {
            abort(404);
        }

        return $next($request);
    }

    /**
     * If application is already updated.
     *
     * @return bool
     */
    private function alreadyUpdated(): bool
    {
        $migrations = $this->getMigrations();
        $dbMigrations = $this->getExecutedMigrations();

        // If the count of migrations and dbMigrations is equal,
        // then the update as already been updated.
        // Otherwise, the app needs an update.
        return count($migrations) == count($dbMigrations);
    }
}
