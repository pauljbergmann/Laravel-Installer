<?php

namespace Pauljbergmann\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Pauljbergmann\LaravelInstaller\Helpers\DatabaseManager;

class DatabaseController extends Controller
{
    /**
     * @var DatabaseManager
     */
    private DatabaseManager $databaseManager;

    /**
     * The constructor.
     *
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function database(): \Illuminate\Http\RedirectResponse
    {
        // Migrations and seeders may take more than 30 seconds.
        // Therefore, we need to disable the time limit for execution.
        set_time_limit(0);

        $response = $this->databaseManager->migrateAndSeed();

        return redirect()
            ->route('LaravelInstaller::final')
            ->with(['message' => $response]);
    }
}
