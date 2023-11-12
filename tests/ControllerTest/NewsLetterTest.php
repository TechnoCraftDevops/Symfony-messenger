<?php

namespace App\tests\ControllerTest;

use App\DataFixtures\NewsLetterFixtures;
use App\Repository\NewsLetterRepository;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

class NewsLetterTest extends WebTestCase
{
    protected $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        
        $databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $databaseTool->loadFixtures([NewsLetterFixtures::class]);
    }

    public function testNewsLetter(): void
    {
        
        $container = static::getContainer();
        
        $newsletterRepo = $container->get(NewsLetterRepository::class);
        $allNewsLetter = $newsletterRepo->findAll();

        $theNewsLetterForUsers = $allNewsLetter[0];
        $newsLetterId = $theNewsLetterForUsers->getId();

        $this->client->request(
            "POST",
            "/newsLetter/send/$newsLetterId"
        );

        $transport = $this->getContainer()->get('messenger.transport.async');
        $this->assertCount(6, $transport->getSent());

        $this->client->followRedirects();
        $this->client->request('GET', '/newsLetter');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(200);
    }

    private function runWorker()
    {
        do{
            // Run the messenger:consume command
            $application = new Application(self::$kernel);
            $application->setAutoExit(true);

            $input = new ArrayInput([
                'command' => 'messenger:consume',
            ]);

            $output = new BufferedOutput(4);
            $run = $application->run($input, $output);

            $input = new ArrayInput([
                'command' => 'messenger:stop-workers',
            ]);
            $output = new BufferedOutput(4);
            $run = $application->run($input, $output);
            
            dd($run);
        } while (!$run);
    }

    // public function testMessenger(): void
    // {
    //     $transport = $this->getContainer()->get('messenger.transport.async');
    //     $this->assertCount(1, $transport->getSent());
    // }
}
