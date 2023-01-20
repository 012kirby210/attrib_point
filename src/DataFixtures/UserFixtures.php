<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

		$faker = Factory::create();
		for ( $i=0; $i<10; $i++){
			$user = new User();
			$user->setNom($faker->name);
			$user->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 days','now')));
			$manager->persist($user);
			$this->addReference(User::class . '-' . $i, $user);
		}
        $manager->flush();
    }

}
