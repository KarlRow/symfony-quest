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
      foreach (ProgramFixtures::PROGRAMS as $programDetails) 
      for($seasonNumber = 1; $seasonNumber <= 5; $seasonNumber++) {
          for($episodeNumber = 1; $episodeNumber <= 10; $episodeNumber++) {
              $episode = new Episode();
              $episode->setNumber($episodeNumber);
              $episode->setTitle($faker->text(25));
              $episode->setSeason($this->getReference('program_' . $programDetails['title'] . 'season_' . $seasonNumber));
              $episode->setSynopsis($faker->text(150));
              //... set other episode's properties
              //... create 2 more episodes
              $manager->persist($episode);
  
          }
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
