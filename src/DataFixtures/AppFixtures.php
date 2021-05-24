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
                ->setPassword($encoded)
                ->setCompany($faker->company)
                ->setPhone($faker->numerify('+336########'));

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
                    ->setUser($user)
                    ->setPhone($faker->numerify('+336########'))
                    ->setAddress($faker->streetAddress)
                    ->setCity($faker->city)
                    ->setPostalCode($faker->numerify('####0'));
                $manager->persist($customer);
            }
        }

    }

    public function loadProducts($faker, $manager)
    {

        $brands = ['Apple', 'Samsung', 'Xiaomi', 'Oppo'];
        $names = ['Iphone ', 'Galaxy S', 'Mi ', 'Reno Z'];
        $chargers = ['Lightning', 'Micro USB-C'];
        $colors = ['Abyssal Blue', 'Scarlet', 'Dark Onyx', 'Polar White', 'Sunrise'];
        $storages = ['32', '64', '128', '256', '512'];
        $models = ['Max','Pro', 'S', 'S Plus', 'Special Edition'];

        foreach ($brands as $key => $brand) {
            for ($i = 0; $i <= 3; $i++) {

                $color = $faker->randomElement($colors);
                $storage = $faker->randomElement($storages) . 'Go';
                $charger = $key === 0 ? $chargers[$key] :  $chargers[1];
                $price = $faker->randomFloat(2,100,1000);
                $screen = $faker->randomFloat(2,4,7);
                $name = $names[$key] . ($faker->numberBetween(4,10) + $i);
                $model = $faker->randomElement($models);

                $product = new Product();
                $product->setBrand($brand)
                    ->setName($name)
                    ->setModel($model)
                    ->setPrice($price)
                    ->setColor($color)
                    ->setScreenSize($screen)
                    ->setStorage($storage)
                    ->setChargerType($charger);
                $manager->persist($product);
            }
        }

    }


}
