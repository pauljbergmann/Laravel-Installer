<?php

namespace Pauljbergmann\LaravelInstaller\Helpers;

class RequirementsChecker
{
    /**
     * Contains the minimum version for PHP.
     *
     * @var string
     */
    private string $_minPhpVersion = '7.4.0';

    /**
     * Check for the server requirements.
     *
     * @param array $requirements
     * @return array
     */
    public function check(array $requirements): array
    {
        $results = [];

        foreach ($requirements as $requirement) {
            $results['requirements'][$requirement] = true;

            if (! extension_loaded($requirement)) {
                $results['requirements'][$requirement] = false;

                $results['errors'] = true;
            }
        }

        return $results;
    }

    /**
     * Check the current PHP version against the minimum set PHP version.
     *
     * @param string|null $minPhpVersion
     * @return array
     */
    public function checkPHPVersion(string $minPhpVersion = null): array
    {
        $currentPhpVersion = $this->getPhpVersionInfo();
        $supported = false;

        if ($minPhpVersion === null) {
            $minPhpVersion = $this->getMinPhpVersion();
        }

        if (version_compare($currentPhpVersion['version'], $minPhpVersion) >= 0) {
            $supported = true;
        }

        return [
            'full' => $currentPhpVersion['full'],
            'current' => $currentPhpVersion['version'],
            'minimum' => $minPhpVersion,
            'supported' => $supported
        ];
    }

    /**
     * Get current Php version information.
     *
     * @return array
     */
    private function getPhpVersionInfo(): array
    {
        $currentVersionFull = PHP_VERSION;
        preg_match("#^\d+(\.\d+)*#", $currentVersionFull, $filtered);
        $currentVersion = $filtered[0];

        return [
            'full' => $currentVersionFull,
            'version' => $currentVersion,
        ];
    }

    /**
     * Get minimum PHP version ID.
     *
     * @return string _minPhpVersion
     */
    protected function getMinPhpVersion(): string
    {
        return $this->_minPhpVersion;
    }
}
