<?php

namespace App\tests\ServiceTest;

use App\Service\VersionService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class VersionServiceTest extends KernelTestCase
{
    protected VersionService $versionService;

    protected function setUp(): void
    {
        // démarrer le kernel
        self::bootKernel();
        // accéder au container de service symfony
        $container = static::getContainer();
        // recupérer le service
        $this->versionService = $container->get(VersionService::class);
    }

    public function testGetCurrentVersion(): void
    {
        $actual = $this->versionService->getCurrentVersion();

        $this->assertIsString($actual);
    }
}
