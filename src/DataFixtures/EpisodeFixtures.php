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
        $faker = Factory::create();

        //src/DataFixtures/EpisodeFixtures.php
      for($i = 1; $i < 10; $i++) {
        $episode = new Episode();
        $episode->setNumber($i);
        $episode->setTitle($faker->text(25));
        $episode->setSeason($this->getReference('season1_Arcane'));
        $episode->setSynopsis($faker->text(150));
        //... set other episode's properties
        //... create 2 more episodes
        $manager->persist($episode);
      }
      $manager->flush();
    }
    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}