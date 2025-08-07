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

        $manager->flush();
    }
}























// namespace App\DataFixtures;

// use App\Entity\User;
// use Doctrine\Bundle\FixturesBundle\Fixture;
// use Doctrine\Persistence\ObjectManager;
// use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
// use Faker\Factory;

// class UserFixtures extends Fixture
// {
//     private UserPasswordHasherInterface $passwordHasher;

//     public function __construct(UserPasswordHasherInterface $passwordHasher)
//     {
//         $this->passwordHasher = $passwordHasher;
//     }

//     public function load(ObjectManager $manager): void
//     {
//         $faker = Factory::create();

//         for ($i = 0; $i < 10; $i++) {
//             $user = new User();
//             $user->setNom($faker->lastName());
//             $user->setPrenom($faker->firstName());
//             $user->setEmail($faker->email());
//             $user->setRole('ROLE_USER');          
//             $user->setDateInscription(new \DateTime());

//             $hashedPassword = $this->passwordHasher->hashPassword($user, 'password');
//             $user->setMotDePasse($hashedPassword);

//             $manager->persist($user);

//             $this->addReference("user_$i", $user);
//         }

//         $admin = new User();                     
//         $admin->setNom('Admin');
//         $admin->setPrenom('Super');
//         $admin->setEmail('admin@example.com');
//         $admin->setRole('ROLE_ADMIN');            
//         $admin->setDateInscription(new \DateTime());

//         $hashedPassword = $this->passwordHasher->hashPassword($admin, 'admin123');
//         $admin->setMotDePasse($hashedPassword);

//         $manager->persist($admin);
//         $this->addReference('admin', $admin);

//         $manager->flush();
//     }
// }
