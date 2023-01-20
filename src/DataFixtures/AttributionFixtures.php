<?php

namespace App\DataFixtures;

use App\Entity\Attribution;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AttributionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

		$faker = Factory::create();
		for ( $i=0; $i<15; $i++){
			$attribution = new Attribution();
			/** @var User $user */
			$user = $this->getReference(User::class.'-'.rand(0,9));
			$attribution->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-10 days','now')));
			$attribution->setBeneficiaire($user);
			$user->addAttribution($attribution);
			$attribution->setPoints(rand(0,2));
			$manager->persist($attribution);
			$manager->persist($user);
		}
        $manager->flush();
    }


	public function getDependencies()
	{
		return [
			UserFixtures::class,
		];
	}
}
