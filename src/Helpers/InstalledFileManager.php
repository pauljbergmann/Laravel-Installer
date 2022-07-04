<?php

namespace Pauljbergmann\LaravelInstaller\Helpers;

class InstalledFileManager
{
    /**
     * Create installed file.
     *
     * @return void
     */
    public function create()
    {
        file_put_contents(storage_path('installed'), '');
    }

    /**
     * Update installed file.
     *
     * @return void
     */
    public function update()
    {
        $this->create();
    }

    /**
     * If application is already installed.
     *
     * @return bool
     */
    public static function alreadyInstalled(): bool
    {
        return file_exists(storage_path('installed'));
    }
}
