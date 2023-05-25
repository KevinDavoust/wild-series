<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Season;
use Faker\Factory;
use Faker\Generator;
use Faker\Provider;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $fakerr = new Generator();
        $fakerr->addProvider( new Provider\fr_FR\Address($fakerr));

        for($program = 1; $program < 6; $program++) {
            for ($saison = 1; $saison < 6; $saison++) {

                $season = new Season();
                $season->setNumber($saison);
                $season->setProgram($this->getReference('program_' . $program));
                $season->setYear($faker->year());
                $season->setDescription($fakerr->region());
                $manager->persist($season);
                $this->addReference('program_' . $program . '_season_' . $saison, $season);
                $manager->flush();
            }

        }

    }

    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class
        ];
    }
}
