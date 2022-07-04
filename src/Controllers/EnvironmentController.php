<?php

namespace Pauljbergmann\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use Pauljbergmann\LaravelInstaller\Helpers\EnvironmentManager;
use Pauljbergmann\LaravelInstaller\Request\UpdateRequest;

class EnvironmentController extends Controller
{
    /**
     * @var EnvironmentManager
     */
    protected EnvironmentManager $environmentManager;

    /**
     * The constructor.
     *
     * @param EnvironmentManager $environmentManager
     */
    public function __construct(EnvironmentManager $environmentManager)
    {
        $this->environmentManager = $environmentManager;
    }

    /**
     * Display the Environment page.
     *
     * @return \Illuminate\View\View
     */
    public function environment(): \Illuminate\View\View
    {
        $envConfig = $this->environmentManager->getEnvContent();

        return view('vendor.installer.environment', compact('envConfig'));
    }

    /**
     * Save the environment variables.
     *
     * @param UpdateRequest $request
     * @return array
     */
    public function save(UpdateRequest $request): array
    {
        return $this->environmentManager->saveFile($request);
    }
}
