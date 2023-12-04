<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Episode;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager) 

    {
      //src/DataFixtures/EpisodeFixtures.php
      $episode = new Episode();
      $episode->setTitle('Welcome to the Playground');
      $episode->setNumber(1);
      $episode->setSynopsis('Les sœurs orphelines Vi et Powder causent des remous dans les rues souterraines de Zaun à la suite d\'un braquage dans le très huppé Piltover.');
      $episode->setSeason($this->getReference('season1_Arcane'));
      //... set other episode's properties
      //... create 2 more episodes
      $manager->persist($episode);

      $episode = new Episode();
      $episode->setTitle('Certains mystères ne devraient jamais être résolus');
      $episode->setNumber(2);
      $episode->setSynopsis('Idéaliste, le chercheur Jayce tente de maîtriser la magie par la science malgré les avertissements de son mentor. Le criminel Silco teste une substance puissante.');
      $episode->setSeason($this->getReference('season1_Arcane'));
      //... set other episode's properties
      //... create 2 more episodes
      $manager->persist($episode);

      $manager->flush();
    }
    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}