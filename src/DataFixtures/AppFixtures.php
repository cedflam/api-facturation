<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++){
            $user = new User();
            $user->setFirstName($faker->firstName)
                 ->setLastName($faker->lastName)
                 ->setCompanyName($faker->company)
                 ->setAddress($faker->streetAddress)
                 ->setPostalCode($faker->postcode)
                 ->setCity($faker->city)
                 ->setEmail($faker->companyEmail)
                 ->setTel($faker->e164PhoneNumber)
                 ->setLegalMention1("30% à la signature du devis, 30% au milieu du chantier, 40% à la livraison")
                 ->setRcs("RCS Pontoise n°1012454512 ")
                 ->setPassword($this->encoder->encodePassword($user, "password"))
            ;
            $manager->persist($user);

            for ($j = 0; $j < 5; $j++){
                $customer = new Customer();
                $customer->setFirstName($faker->firstName)
                         ->setLastName($faker->lastName)
                         ->setAddress($faker->streetAddress)
                         ->setPostalCode($faker->postcode)
                         ->setCity($faker->city)
                         ->setEmail($faker->email)
                         ->setTel($faker->e164PhoneNumber)
                         ->setUser($user)
                ;
                $manager->persist($customer);
            }
        }

        $manager->flush();
    }
}
