<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        for($program = 1; $program < 6; $program++) {

            for ($saison =1; $saison <6; $saison++){

                for ($episodee = 1; $episodee < 11; $episodee++){

                    $episode = new Episode();
                    $episode->setNumber($episodee);
                    $episode->setSeason($this->getReference('program_' . $program . '_season_' . $saison));
                    $episode->setTitle($faker->word());
                    $episode->setSynopsis($faker->paragraphs(1, true));
                    $manager->persist($episode);
                    $this->addReference('program_' . $program . '_season_' . $saison . '_episode_' . $episodee, $episode);
                }
            }


        }
        $manager->flush();
        /*
        $episode = new Episode();
        $episode->setSeason($this->getReference('Gotaga_season1'));
        $episode->setTitle('Episode 1');
        $episode->setSynopsis('Début de l\'aventure pour le petit Corentin');
        $episode->setNumber(1);
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setSeason($this->getReference('Gotaga_season1'));
        $episode->setTitle('Episode 2');
        $episode->setSynopsis('Suite de l\'aventure pour le petit Corentin');
        $episode->setNumber(2);
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setSeason($this->getReference('Gotaga_season1'));
        $episode->setTitle('Episode 3');
        $episode->setSynopsis('Fin de l\'aventure pour le petit Corentin');
        $episode->setNumber(3);
        $manager->persist($episode);
        $manager->flush();
        */
    }

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class
        ];
    }
}
