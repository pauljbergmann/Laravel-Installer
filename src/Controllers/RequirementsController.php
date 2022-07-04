<?php

namespace Pauljbergmann\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Pauljbergmann\LaravelInstaller\Helpers\RequirementsChecker;

class RequirementsController extends Controller
{
    /**
     * @var RequirementsChecker
     */
    protected RequirementsChecker $requirements;

    /**
     * The constructor.
     *
     * @param RequirementsChecker $checker
     */
    public function __construct(RequirementsChecker $checker)
    {
        $this->requirements = $checker;
    }

    /**
     * Display the requirements page.
     *
     * @return \Illuminate\View\View
     */
    public function requirements(): \Illuminate\View\View
    {
        $phpSupportInfo = $this->requirements->checkPHPversion(
            config('installer.core.minPhpVersion')
        );

        $requirements = $this->requirements->check(
            config('installer.requirements')
        );

        return view('vendor.installer.requirements', compact(
            'requirements',
            'phpSupportInfo'
        ));
    }
}
