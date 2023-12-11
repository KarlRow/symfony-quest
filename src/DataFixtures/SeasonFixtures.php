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
    //pour chaque programe, on ajoute de 1 à 5 saison
    foreach (ProgramFixtures::PROGRAMS as $programDetails) {
        for($seasonNumber = 1; $seasonNumber <= 5; $seasonNumber++) {
            $season = new Season();
            //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
            $season->setNumber($seasonNumber);
            $season->setProgram($this->getReference('program_' . $programDetails['title']));
            $season->setYear($faker->year());
            $season->setDescription($faker->text(150));
            //... set other season's properties
            $manager->persist($season);
            $this->addReference('program_' . $programDetails['title'] . 'season_' . $seasonNumber, $season);
        }
        $manager->flush();
        }
    }


    public function getDependencies(): array
    {
        return [
           ProgramFixtures::class,
        ];
    }
}