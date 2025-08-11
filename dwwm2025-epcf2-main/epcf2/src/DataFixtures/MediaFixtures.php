<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\Lieu;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $images = [
            'evenement_001.jpg',
            'evenement_002.jpg',
            'evenement_003.jpg',
            'evenement_004.jpg',
            
        ];

        $lieux = $manager->getRepository(Lieu::class)->findAll();

        foreach ($lieux as $lieu) {
            $media = new Media();
            $media->setCheminFichier('images/' . $faker->randomElement($images));
            $media->setType('image/jpeg');
            $media->setLieu($lieu);

            $manager->persist($media);
            $this->addReference('media_lieu_' . $lieu->getId(), $media);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LieuFixtures::class,
        ];
    }
}