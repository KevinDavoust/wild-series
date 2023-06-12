<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $program = new Program();
        $program->setTitle('Walking Dead');
        $program->setSlug($this->slugger->slug($program->getTitle()));
        $program->setSynopsis('Des zombies veulent manger Rick');
        $program->setCategory($this->getReference('category_Action'));
        $manager->persist($program);
        $this->addReference('program_1', $program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('One Piece');
        $program->setSlug($this->slugger->slug($program->getTitle()));
        $program->setSynopsis('Le roi des pirates, ce sera lui !');
        $program->setCategory($this->getReference('category_Aventure'));
        $manager->persist($program);
        $this->addReference('program_2', $program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Porco Rosso');
        $program->setSlug($this->slugger->slug($program->getTitle()));
        $program->setSynopsis('Cochon guerre boum boum avion');
        $program->setCategory($this->getReference('category_Animation'));
        $manager->persist($program);
        $this->addReference('program_3', $program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Le seigneur des anneaux');
        $program->setSlug($this->slugger->slug($program->getTitle()));
        $program->setSynopsis('mdr le hobbit petit bonhomme');
        $program->setCategory($this->getReference('category_Fantastique'));
        $manager->persist($program);
        $this->addReference('program_4', $program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Gotaga chez les Gorons');
        $program->setSlug($this->slugger->slug($program->getTitle()));
        $program->setSynopsis('Corentin Houssein débarque ches les grignoteurs de savouroche');
        $program->setCategory($this->getReference('category_Horreur'));
        $manager->persist($program);
        $this->addReference('program_5', $program);
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class
        ];
    }

}
