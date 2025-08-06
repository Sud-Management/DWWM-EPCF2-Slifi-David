<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 3; $i++) {
            $categorie = new Categorie();
            $categorie->setNom("Catégorie $i");
            $categorie->setDescription($faker->sentence());

            $manager->persist($categorie);
            $this->addReference("categorie_$i", $categorie);
        }

        $manager->flush();
    }
}

















// namespace App\DataFixtures;

// use App\Entity\Categorie;
// use Doctrine\Bundle\FixturesBundle\Fixture;
// use Doctrine\Persistence\ObjectManager;
// use Faker\Factory;

// class CategorieFixtures extends Fixture
// {
//     public function load(ObjectManager $manager): void
//     {
//         $faker = Factory::create('fr_FR');

//         for ($i = 1; $i <= 5; $i++) {
//             $categorie = new Categorie();
//             $categorie
//                 ->setNom(ucfirst($faker->unique()->word()))
//                 ->setDescription($faker->sentence(10));

//             $manager->persist($categorie);

            
//             $this->addReference('categorie_' . $i, $categorie);
//         }

//         $manager->flush();
//     }
// }
