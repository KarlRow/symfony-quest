<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $program = new Program();
        $program->setTitle('The Walking Dead');
        $program->setSynopsis('Le monde s\'éffonddre à cause d\'un virus affecte les humains en les transformant en zombies.');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Dark');
        $program->setSynopsis('Lorsque deux enfants disparaissent dans une petite ville allemande, son passé tragique refait surface.');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('YOU');
        $program->setSynopsis('Un charmant libraire répondant au nom de Joe utilise les nouvelles technologies pour attirer la jolie romancière Beck et la faire tomber amoureuse. Son obsession envers Beck devient dangereuse mais Joe est prêt à tout.');
        $program->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Vikings: Valhalla');
        $program->setSynopsis('Les aventures de certains des Vikings les plus célèbres de l\'histoire qui ouvrent de nouvelles voies dans une Europe en constante évolution : l\'explorateur Leif Eriksson, sa soeur Freydis Eriksdotter et l\'ambitieux Prince du Nord Harald Sigurdsson.');
        $program->setCategory($this->getReference('category_Aventure'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('L\'ATTAQUE DES TITANS');
        $program->setSynopsis('Dans un monde ravagé par des titans mangeurs d’homme depuis plus d’un siècle, les rares survivants de l’Humanité n’ont d’autre choix pour survivre que de se barricader dans une cité-forteresse. Le jeune Eren, témoin de la mort de sa mère dévorée par un titan, n’a qu’un rêve : entrer dans le corps d’élite chargé de découvrir l’origine des Titans et les annihiler jusqu’au dernier…');
        $program->setCategory($this->getReference('category_Animation'));
        $manager->persist($program);
        $manager->flush();

    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CategoryFixtures::class,
        ];
    }


}