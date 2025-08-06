<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Entity\Lieu;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EvenementFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 5; $i++) {
            $evenement = new Evenement();

            $evenement->setTitre("Événement numéro $i");
            $evenement->setDescription("Description fixe pour l'événement $i.");
            $evenement->setDateDebut((new \DateTime())->modify("+$i days"));
            $evenement->setDateFin((new \DateTime())->modify("+".($i + 1)." days"));
            $evenement->setCapacite(50 + $i * 10);
            $evenement->setEstPublic(true);
            $evenement->setDateCreation(new \DateTime());

            $evenement->setOrganisateur($this->getReference('user_1', User::class)); 
            $evenement->setCategorie($this->getReference('categorie_1', Categorie::class));
            $evenement->setLieu($this->getReference('lieu_1', Lieu::class));

            $manager->persist($evenement);
            $this->addReference('evenement_' . $i, $evenement);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CategorieFixtures::class,
            LieuFixtures::class,
        ];
    }
}

