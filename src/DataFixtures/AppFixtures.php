<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $employee1 = new Employee();
         $employee1->setDayStart(10)
             ->setDayEnd(19)
             ->setLunchStart(13)
             ->setLunchDuration(1)
             ;
         $manager->persist($employee1);

        $employee2 = new Employee();
        $employee2->setDayStart(9)
            ->setDayEnd(18)
            ->setLunchStart(12)
            ->setLunchDuration(1);
        $manager->persist($employee2);


        $manager->flush();
    }
}
