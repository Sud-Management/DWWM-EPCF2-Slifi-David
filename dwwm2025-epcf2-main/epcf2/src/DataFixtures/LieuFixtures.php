<?php


namespace App\DataFixtures;

use App\Entity\Lieu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LieuFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 5; $i++) {
            $lieu = new Lieu();
            $lieu->setNom("Salle $i");
            $lieu->setAdresse($faker->streetAddress());
            $lieu->setVille($faker->city());
            $lieu->setCodePostal($faker->postcode());

            $manager->persist($lieu);
            $this->addReference("lieu_$i", $lieu);
        }

        $manager->flush();
    }
}









// namespace App\DataFixtures;

// use App\Entity\Lieu;
// use Doctrine\Bundle\FixturesBundle\Fixture;
// use Doctrine\Persistence\ObjectManager;

// class LieuFixtures extends Fixture
// {
//     public function load(ObjectManager $manager): void
//     {
//         for ($i = 1; $i <= 5; $i++) {
//             $lieu = new Lieu();
//             $lieu->setNom("Lieu $i")
//                 ->setAdresse("Adresse $i")
//                 ->setVille("Ville $i")
//                 ->setCodePostal("7500$i");

//             $manager->persist($lieu);
//             $this->addReference("lieu_$i", $lieu);
//         }

//         $manager->flush();
//     }
// }
