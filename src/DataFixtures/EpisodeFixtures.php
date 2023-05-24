<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
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
    }

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class
        ];
    }
}
