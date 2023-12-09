<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

//Tout d'abord nous ajoutons la classe Factory de FakerPhp
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //Puis ici nous demandons à la Factory de nous fournir un Faker
        $faker = Factory::create();

        /**
        * L'objet $faker que tu récupère est l'outil qui va te permettre 
        * de te générer toutes les données que tu souhaites
        */

        for($i =1; $i <= 5; $i++) {
            $season = new Season();
            //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
            $season->setNumber($i);
            $season->setProgram($this->getReference('program_Arcane'));
            $season->setYear('2021');
            $season->setDescription('Première saison de Arcane');
            //... set other season's properties
            $this->setReference('season1_Arcane', $season);
            $manager->persist($season);


            $manager->persist($season);
        }

        $manager->flush();
    }


    public function getDependencies(): array
    {
        return [
           ProgramFixtures::class,
        ];
    }
}