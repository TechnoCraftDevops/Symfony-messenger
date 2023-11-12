<?php

namespace App\tests\ControllerTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthCheckTest extends WebTestCase
{
    protected $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testGetCurrentVersion(): void
    {
        $this->client->request(
            'GET',
            '/api/healthCheck'
        );

        $jsonResponse = $this->client->getResponse()->getContent();
        $jsonResponseDecoded = json_decode($jsonResponse, true);


        $this->assertResponseIsSuccessful('health_check => unsuccessful response');
        $this->assertResponseStatusCodeSame(200, 'health_check => http code is not same');
        $this->assertEquals('no version', $jsonResponseDecoded['version'], 'health_check => version error');
        $this->assertEquals('service up !', $jsonResponseDecoded['status'], 'health_check => status error');
        $this->assertIsString($jsonResponseDecoded['status'], 'health_check => status is not string');
    }
}
