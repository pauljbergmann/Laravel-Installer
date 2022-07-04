<?php

namespace Pauljbergmann\LaravelInstaller\Helpers;

use Exception;
use Illuminate\Database\SQLiteConnection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DatabaseManager
{
    /**
     * Migrate and seed the database.
     *
     * @return array
     */
    public function migrateAndSeed(): array
    {
        $this->sqlite();

        return $this->migrate();
    }

    /**
     * Run the migration and call the seeder.
     *
     * @return array
     */
    private function migrate(): array
    {
        try {
            Artisan::call('migrate', ["--force" => true]);
        } catch(Exception $e){
            return $this->response($e->getMessage());
        }

        return $this->seed();
    }

    /**
     * Seed the database.
     *
     * @return array
     */
    private function seed(): array
    {
        try{
            Artisan::call('db:seed');
        } catch (Exception $e){
            return $this->response($e->getMessage());
        }

        return $this->response(trans('installer_messages.final.finished'), 'success');
    }

    /**
     * Return a formatted error messages.
     *
     * @param $message
     * @param string $status
     * @return array
     */
    private function response($message, string $status = 'danger'): array
    {
        return [
            'status' => $status,
            'message' => $message,
        ];
    }

    /**
     * Check the database type. If SQLite, then create the database file.
     *
     * @return void
     */
    private function sqlite()
    {
        if (DB::connection() instanceof SQLiteConnection) {
            $database = DB::connection()->getDatabaseName();

            if (! file_exists($database)) {
                touch($database);

                DB::reconnect(Config::get('database.default'));
            }
        }
    }
}
