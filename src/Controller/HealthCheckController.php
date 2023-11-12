<?php

namespace App\Controller;

use App\Service\VersionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheckController extends AbstractController
{
    #[Route('/api/healthCheck', name: 'health_check', methods:'GET')]
    public function healthCheck(VersionService $versionService): JsonResponse
    {
        return new JsonResponse(
            [
            'status' => 'service up !',
            'version' => $versionService->getCurrentVersion()
            ],
            200
        );
    }
}
