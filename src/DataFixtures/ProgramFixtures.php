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
      'synopsis' => 'Le marchand de sable doit reconstruire son royame',
      'poster' => 'sandman.jpeg',
      'category' => 'Fantastique'],

      ['title' => 'Walking dead', 
      'synopsis' => 'Des zombies envahissent la terre',
      'poster' => 'walking_dead.jpeg',
      'category' => 'Horreur'],

      ['title' => 'Inside Man', 
      'synopsis' => 'un condamné à mort résoud des enquêtes',
      'poster' => 'inside_man.jpeg',
      'category' => 'Policier'],

      ['title' => 'Warrior nun', 
      'synopsis' => 'une jeune fille se retrouve enrolée dans une armée de nonne pour combattre le mal',
      'poster' => 'warrior_nun.webp',
      'category' => 'Fantastique'],

      ['title' => '13 reason why', 
      'synopsis' => 'Une jeune femme enregistre plusieurs cassette dans lesquelles elle explique les raisons de son suicide',
      'poster' => '13_reason_why.jpeg',
      'category' => 'Drame'],
    ];


    public function load(ObjectManager $manager): void
    {

        foreach (self:: PROGRAMS as $key => $serie ){
         $program = new Program();
         $program->setTitle($serie['title']);
         $program->setSynopsis($serie['synopsis']);
         $program->setPoster($serie['poster']);
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
