<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
      ['title' => 'The Sandman', 
      'synopsis' => 'Le marchand de sable doit reconstruire son royame', 'category' => 'Fantastique'],

      ['title' => 'Walking dead', 
      'synopsis' => 'Des zombies envahissent la terre',
       'category' => 'Horreur'],

      ['title' => 'Inside Man', 
      'synopsis' => 'un condamné à mort résoud des enquêtes', 
      'category' => 'Policier'],

      ['title' => 'Warrior nun', 
      'synopsis' => 'une jeune fille se retrouve enrolée dans une armée de nonne pour combattre le mal', 
      'category' => 'Fantastique'],

      ['title' => '13 reason why', 
      'synopsis' => 'Une jeune femme enregistre plusieurs cassette dans lesquelles elle explique les raisons de son suicide', 
      'category' => 'Drame'],
    ];


    public function load(ObjectManager $manager): void
    {

        foreach (self:: PROGRAMS as $key => $serie ){
         $program = new Program();
         $program->setTitle($serie['title']);
         $program->setSynopsis($serie['synopsis']);
         $program->setCategory($this->getReference('category_' . $serie['category']));
         $manager->persist($program); 
        }
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
