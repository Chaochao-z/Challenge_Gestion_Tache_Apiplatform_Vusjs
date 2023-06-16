<?php

namespace App\DataFixtures;

use App\Entity\Tache;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        for ($i = 0 ; $i<30; $i++)
        {
            $faker = Factory::create();
            $tache = new Tache();
            $tache->setDescription($faker->text());
            $tache->setTitre($faker->word());
            $tache->setPriotity($faker->numberBetween(1,3));
            $tache->setStatus(0);
            $manager->persist($tache);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
