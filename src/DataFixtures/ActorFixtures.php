<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        foreach (ProgramFixtures::PROGRAMS as $programDetails) {
            for ($actorName = 0; $actorName < 10; $actorName++) {
                $actor = new Actor();
                $actor->setName($faker->name());

                // Choisissez aléatoirement trois programmes parmi ceux disponibles
                $programsReferences = array_rand(ProgramFixtures::PROGRAMS, 3);

                foreach ($programsReferences as $programDetails) {
                    $programReference = 'program_' . $programDetails;
                    $program = $this->getReference($programReference);
                    $actor->addProgram($program);
                }

                $manager->persist($actor);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}

