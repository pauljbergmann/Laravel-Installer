<?php

namespace Pauljbergmann\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Pauljbergmann\LaravelInstaller\Helpers\PermissionsChecker;

class PermissionsController extends Controller
{
    /**
     * @var PermissionsChecker
     */
    protected PermissionsChecker $permissions;

    /**
     * The constructor.
     *
     * @param PermissionsChecker $checker
     */
    public function __construct(PermissionsChecker $checker)
    {
        $this->permissions = $checker;
    }

    /**
     * Display the permissions check page.
     *
     * @return \Illuminate\View\View
     */
    public function permissions(): \Illuminate\View\View
    {
        $permissions = $this->permissions->check(
            config('installer.permissions')
        );

        return view('vendor.installer.permissions', compact('permissions'));
    }
}
