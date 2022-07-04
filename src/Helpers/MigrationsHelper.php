<?php

namespace Pauljbergmann\LaravelInstaller\Helpers;

use Illuminate\Support\Facades\DB;

trait MigrationsHelper
{
    /**
     * Get the migrations in path '/database/migrations'.
     *
     * @return array
     */
    public function getMigrations(): array
    {
        $migrations = glob(
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . '*.php'
        );

        return str_replace('.php', '', $migrations);
    }

    /**
     * Get the migrations that have already been running.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getExecutedMigrations(): \Illuminate\Support\Collection
    {
        // The migrations' table should exist.
        // If not, the user will receive an error.
        return DB::table('migrations')
            ->get()
            ->pluck('migration');
    }
}
