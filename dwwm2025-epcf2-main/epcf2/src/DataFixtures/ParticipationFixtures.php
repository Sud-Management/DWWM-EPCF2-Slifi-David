<?php
namespace App\DataFixtures;

use App\Entity\Evenement;
use App\Entity\Participation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ParticipationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $statuts = ['validé', 'en attente', 'refusé'];

        for ($i = 1; $i <= 9; $i++) {
            $participation = new Participation();
            $participation
                ->setStatut($faker->randomElement($statuts))
                ->setDateParticipation($faker->dateTimeBetween('-2 months', 'now'))
                ->setUtilisateur($this->getReference('user_' . $i, User::class))
                ->setEvenement($this->getReference('evenement_' . $faker->numberBetween(1, 5), Evenement::class));

            $manager->persist($participation);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            EvenementFixtures::class,
            UserFixtures::class,
        ];
    }
}
