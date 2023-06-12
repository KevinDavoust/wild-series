<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $hashedpassword = $this->passwordHasher->hashPassword(
            $user,
            '123'
        );
        $user->setEmail('user@user.fr');
        $user->setPassword($hashedpassword);
        $user->setRoles(['ROLE_CONTRIBUTOR']);

        $manager->persist($user);
        $this->addReference('contributor', $user);


        $admin = new User();
        $hashedpassword = $this->passwordHasher->hashPassword(
            $admin,
            '123'
        );
        $admin->setPassword($hashedpassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setEmail('admin@admin.fr');

        $manager->persist($admin);

        $manager->flush();
    }
}
