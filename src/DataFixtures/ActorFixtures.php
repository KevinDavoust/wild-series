<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use Faker\Generator;
use Faker\Provider;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $fakerr = new Generator();
        $fakerr->addProvider( new Provider\nl_NL\Company($fakerr));

        for($acteur = 1; $acteur < 11; $acteur++) {

            $actor = new Actor();
            $actor->setName($fakerr->jobTitle());

            for ($program = 1; $program < 4; $program++) {

                $actor->addProgram($this->getReference('program_' . $program));
                $manager->persist($actor);


            }
            $this->addReference('actor_' . $acteur, $actor);
            $manager->flush();

        }
    }

    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class
        ];
    }
}
