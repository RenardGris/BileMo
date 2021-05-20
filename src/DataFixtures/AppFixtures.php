<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $this->loadUsers($faker, $manager);
        $this->loadProducts($faker, $manager);
        $this->loadCustomers($faker, $manager);


        $manager->flush();
    }


    public function loadUsers($faker, $manager)
    {
        for ($i = 0; $i <= 5; ++$i) {
            $user = new User();
            $encoded = password_hash('demo', PASSWORD_DEFAULT);

            $user->setFirstname($faker->firstName)
                ->setLastname($faker->lastname)
                ->setEmail($faker->email)
                ->setPassword($encoded);

            $manager->persist($user);
        }
        $manager->flush();

    }

    public function loadCustomers($faker, $manager)
    {
        $users = $manager->getRepository(User::class)->findAll();
        foreach($users as $user){
            for ($i = 0; $i <= 3; ++$i) {
                $customer = new Customer();

                $customer->setFirstname($faker->firstName)
                    ->setLastname($faker->lastname)
                    ->setEmail($faker->email)
                    ->setUser($user);
                $manager->persist($customer);
            }
        }

    }

    public function loadProducts($faker, $manager)
    {

        $brands = ['Apple', 'Samsung', 'Xiaomi', 'Oppo'];
        $name = ['Iphone ', 'Galaxy S', 'Mi ', 'Reno Z'];

        foreach ($brands as $key => $brand) {
            for ($i = 0; $i <= 3; $i++) {
                $product = new Product();
                $product->setName($name[$key] . ($faker->numberBetween(4,10) + $i) )
                    ->setBrand($brand)
                    ->setModel($faker->randomElement(['32', '64', '128', '256', '512']) . 'Go')
                    ->setPrice($faker->randomFloat(2,100,1000));
                $manager->persist($product);
            }
        }

    }


}
