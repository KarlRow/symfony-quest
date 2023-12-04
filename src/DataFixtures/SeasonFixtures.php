<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Season;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)

    {
        //src/DataFixtures/SeasonFixtures.php
        $season = new Season();
        $season->setNumber(1);
        $season->setProgram($this->getReference('program_Arcane'));
        $season->setYear('2021');
        $season->setDescription('Saison 1');
        //... set other season's properties
        $this->addReference('season1_Arcane', $season);
        $manager->persist($season);

        //src/DataFixtures/SeasonFixtures.php
        $season = new Season();
        $season->setNumber(2);
        $season->setProgram($this->getReference('program_Arcane'));
        $season->setYear('2021');
        $season->setDescription('Saison 1');
        //... set other season's properties
        $this->setReference('season1_Arcane', $season);
        $manager->persist($season);

        $manager->flush();

    }
    
    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }
}