<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\Evenement;
use App\Entity\Lieu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $types = ['image', 'video', 'audio'];

        
        for ($i = 1; $i < 5; $i++) {
            $media = new Media();
            $media
                ->setCheminFichier('uploads/media/' . $faker->uuid . '.jpg')
                ->setType($types[$i % count($types)]) 
                ->setEvenement($this->getReference('evenement_' . $i, Evenement::class)) 
                ->setLieu($this->getReference('lieu_' . (($i % 5) + 1), Lieu::class)); 

            $manager->persist($media);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            EvenementFixtures::class,
            LieuFixtures::class,
        ];
    }
}
