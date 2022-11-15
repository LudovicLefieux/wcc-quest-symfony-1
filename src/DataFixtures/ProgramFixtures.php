<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [
            'Title' => 'The Walking Dead',
            'Synopsis' => 'Des zombies veulent nous manger',
            'Category' => 'category_Action'
        ],
        [
            'Title' => 'Daredevil',
            'Synopsis' => 'Un aveugle se prend pour Batman',
            'Category' => 'category_Action'
        ],
        [
            'Title' => 'The Simpsons',
            'Synopsis' => 'Une famille normale',
            'Category' => 'category_Animation'
        ],
        [
            'Title' => 'Breaking Bad',
            'Synopsis' => 'La sécurité sociale c\'est cool',
            'Category' => 'category_Action'
        ],
        [
            'Title' => 'The Witcher',
            'Synopsis' => 'Un mec aux cheveux longs zigouille des monstres pour de l\'argent',
            'Category' => 'category_Fantastique'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $programm) {
            $program = new Program();
            $program->setTitle($programm['Title']);
            $program->setSynopsis($programm['Synopsis']);
            $program->setCategory($this->getReference($programm['Category']));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
          ];
    }
}
