<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Episode;

use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager) 

    {
      $fake = Factory::create();

      //src/DataFixtures/EpisodeFixtures.php
    for($i = 0; $i <= 10; $i++) {
      $episode = new Episode();
      $episode->setTitle($fake->text(25));
      $episode->setNumber($i);
      $episode->setSynopsis($fake->text(150));
      $episode->setSeason($this->getReference('season1_Arcane'));
      //... set other episode's properties
      //... create 2 more episodes
      $manager->persist($episode);
    
      $manager->flush();
    }
    }
    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}