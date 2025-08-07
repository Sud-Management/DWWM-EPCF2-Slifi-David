<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // 9 utilisateurs classiques
        for ($i = 1; $i <= 9; $i++) {
            $user = new User();
            $user->setNom($faker->lastName());
            $user->setPrenom($faker->firstName());
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->setDateInscription(new \DateTime());
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));

            $manager->persist($user);
            $this->addReference("user_$i", $user);
        }

        // Utilisateur admin
        $admin = new User();
        $admin->setNom('Admin');
        $admin->setPrenom('Super');
        $admin->setEmail('admin@example.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setDateInscription(new \DateTime());
        $admin->setPassword($this->passwordHasher->hashPassword($admin, '1605'));

        $manager->persist($admin);
        $this->addReference("admin", $admin);

        // Utilisateur organisateur
        $orga = new User();
        $orga->setNom('Orga');
        $orga->setPrenom('Event');
        $orga->setEmail('orga@example.com');
        $orga->setRoles(['ROLE_ORGA']);
        $orga->setDateInscription(new \DateTime());
        $orga->setPassword($this->passwordHasher->hashPassword($orga, '1605'));

        $manager->persist($orga);
        $this->addReference("orga", $orga);

        $manager->flush();
    }
}
