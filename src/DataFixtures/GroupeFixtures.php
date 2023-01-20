<?php

namespace App\DataFixtures;

use App\Entity\Groupe;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class GroupeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

		$faker = Factory::create();
		for ( $i=0; $i<5; $i++){
			$groupe = new Groupe();
			$groupe->setNom("Groupe".$i);
			$userIndex = rand(0,9);
			$user = $this->getReference(User::class.'-'.$userIndex);
			$groupe->addUser($user);
			$manager->persist($groupe);
			$this->addReference(Groupe::class . '-' . $i, $user);
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
