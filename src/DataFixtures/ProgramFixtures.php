<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $program = new Program();
        $program->setTitle('Walking Dead');
        $program->setSynopsis('Des zombies veulent manger Rick');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('One Piece');
        $program->setSynopsis('Le roi des pirates, ce sera lui !');
        $program->setCategory($this->getReference('category_Aventure'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Porco Rosso');
        $program->setSynopsis('Cochon guerre boum boum avion');
        $program->setCategory($this->getReference('category_Animation'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Le seigneur des anneaux');
        $program->setSynopsis('mdr le hobbit petit bonhomme');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Gotaga chez les Gorons');
        $program->setSynopsis('Corentin Houssein débarque ches les grignoteurs de savouroche');
        $program->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program);
        $this->addReference('program_Gotaga', $program);
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class
        ];
    }

}
