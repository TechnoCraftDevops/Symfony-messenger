<?php

namespace App\Service;

use Symfony\Component\HttpKernel\KernelInterface;

class VersionService
{
    protected $projectDir;

    public function __construct(KernelInterface $kernel)
    {
        $this->projectDir = $kernel->getProjectDir();
    }

    public function getCurrentVersion(): string
    {
        $composerData = json_decode(
            file_get_contents($this->projectDir . '/composer.json'),
            true
        );
        return !isset($composerData['version']) ?
            'no version' :
            $composerData['version'];
    }
}
