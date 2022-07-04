<?php

namespace Pauljbergmann\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Pauljbergmann\LaravelInstaller\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @return \Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager): \Illuminate\View\View
    {
        $fileManager->update();

        return view('vendor.installer.finished');
    }
}
