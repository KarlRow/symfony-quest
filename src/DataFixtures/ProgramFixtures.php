<?php
namespace App\DataFixtures;
use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'The Walking dead' => [
                        'title'    => 'The Walking dead',
                        'synopsis' => 'Après une apocalypse ayant transformé la quasi-totalité de la population en zombies, un groupe d\'hommes et de femmes mené par l\'officier Rick Grimes tente de survivre. Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde.',
                        'category' => 'Action',
                        'poster'   => '/build/images/the-walking-dead.jpg',
                        'country'  => 'Etat-Unis',
                        'year'     => '2010',],
        'Dark' => [
                        'title'    => 'Dark',
                        'synopsis' => 'Lorsque deux enfants disparaissent dans une petite ville allemande, son passé tragique refait surface. Quatre familles à la recherche des enfants vont voir leur routine bouleversée et les secrets de chacun vont être mis en lumière.',
                        'category' => 'Fantastique',
                        'poster'   => '/build/images/dark.jpg',
                        'country'  => 'Allemagne',
                        'year'     => '2017',],
        'YOU' => [
                        'title'    => 'YOU',
                        'synopsis' => 'Un charmant libraire répondant au nom de Joe utilise les nouvelles technologies pour attirer la jolie romancière Beck et la faire tomber amoureuse. Son obsession envers Beck devient dangereuse mais Joe est prêt à tout.',
                        'category' => 'Horreur',
                        'poster'   => '/build/images/you.webp',
                        'country'  => 'Etat-Unis',
                        'year'     => '2018',],
        'Vikings Valhalla' => [
                        'title'    => 'Vikings Valhalla',
                        'synopsis' => 'Les aventures de certains des Vikings les plus célèbres de l\'histoire qui ouvrent de nouvelles voies dans une Europe en constante évolution : l\'explorateur Leif Eriksson, sa soeur Freydis Eriksdotter et l\'ambitieux Prince du Nord Harald Sigurdsson.',
                        'category' => 'Aventure',
                        'poster'   => '/build/images/vikings-vahalla.webp',
                        'country'  => 'Etat-Unis',
                        'year'     => '2022',],
        'L\'Attaque des Titans' => [
                        'title'    => 'L\'Attaque des Titans',
                        'synopsis' => 'Il y a un siècle, l\'humanité a presque été exterminée par des titans qui dévorent les hommes. Les survivants sont regroupés dans une ville fortifiée. C\'est alors qu\'un titan colossal, plus haut que les murs de la ville, se présente devant la cité...',
                        'category' => 'Animation',
                        'poster'   => '/build/images/attaque_des_titans.jpg',
                        'country'  => 'Japon',
                        'year'     => '2013 ',],
        'Arcane' => [
                        'title'    => 'Arcane',
                        'synopsis' => 'Championnes de leurs villes jumelles et rivales (la huppée Piltover et la sous-terraine Zaun), deux sœurs Vi et Powder se battent dans une guerre où font rage des technologies magiques et des perspectives diamétralement opposées.',
                        'category' => 'Animation',
                        'poster'   => '/build/images/arcane.webp',
                        'country'  => 'Etat-Unis',
                        'year'     => '2021',],          
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programDetails) {
            $program = new Program();
            $program->setTitle($programDetails['title']);
            $program->setSynopsis($programDetails['synopsis']);
            $program->setCategory($this->getReference('category_' . $programDetails['category']));
            $program->setPoster($programDetails['poster']);
            $program->setCountry($programDetails['country']);
            $program->setYear($programDetails['year']);
            $manager->persist($program);
            $this->addReference('program_' . $programDetails['title'], $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];

    }
}