<?php

namespace App\DataFixtures;

use App\Entity\NewsLetter;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class NewsLetterFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $newsLetters = [];
        for ($i=1; $i <= 6; $i++) { 
            $newsLetter = new NewsLetter();
            $newsLetter->setName($this->faker->word())
                      ->setContent($this->faker->sentence(4))
                      ->setCreatedAt(DateTimeImmutable::createFromMutable($this->faker->datetime()))
                      ->setIsSent(false);
            $manager->persist($newsLetter);
            $newsLetters[] = $newsLetter;
        }

        for ($i=1; $i <= 6; $i++) { 
            $user = new User();
            $user->setFirstName($this->faker->firstName())
                      ->setLastName($this->faker->lastName())
                      ->setEmail($this->faker->email());
                      foreach ($newsLetters as $newLetter) {
                        $user->addNewsLetter($newLetter);
                      }

            $manager->persist($user);
        }
        $manager->flush();
    }
}
