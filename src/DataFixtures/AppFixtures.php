<?php

namespace App\DataFixtures;

use App\Entity\POI;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        for ($i = 0; $i < 50; $i++) {
            $poi = new POI();
            $poi->setLongitude($faker->longitude);
            $poi->setLatitude($faker->latitude);
            $poi->setTitle('Title ' . $i);
            $poi->setDescription($faker->text(200));
            $poi->setImgSrc($faker->imageUrl());
            $manager->persist($poi);
        }

        $manager->flush();
    }
}
