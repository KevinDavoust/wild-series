<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker\Factory;
use Faker\Generator;
use Faker\Provider;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {


        $faker = Factory::create('fr_FR');
        $fakerr = new Generator();
        $fakerr->addProvider( new Provider\pt_BR\Person($fakerr));
        $fakerBE = new Generator();
        $fakerBE->addProvider(new Provider\fr_BE\Address($fakerBE));
        $fakerBEP = new Generator();
        $fakerBEP->addProvider(new Provider\fr_BE\Person($fakerBEP));


        for($program = 1; $program < 6; $program++) {

            for ($saison =1; $saison <6; $saison++){

                for ($episodee = 1; $episodee < 11; $episodee++){

                    $episode = new Episode();
                    $episode->setNumber($episodee);
                    $episode->setSeason($this->getReference('program_' . $program . '_season_' . $saison));
                    $episode->setTitle($fakerr->name());
                    $episode->setSlug($this->slugger->slug($episode->getTitle()));
                    $episode->setDuration($faker->numberBetween(30, 58));
                    $episode->setSynopsis($fakerBEP->firstNameMale() . ' ' . $fakerBEP->lastName() . ' ' . $fakerBE->province() . ' ' . $fakerBE->cityName());
                    $manager->persist($episode);
                    $this->addReference('program_' . $program . '_season_' . $saison . '_episode_' . $episodee, $episode);
                }
            }


        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class
        ];
    }
}
