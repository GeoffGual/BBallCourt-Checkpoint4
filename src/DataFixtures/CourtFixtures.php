<?php

namespace App\DataFixtures;

use App\Entity\Court;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CourtFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $court = new Court();
        $court->setName('Playground Duperré');
        $court->setAddress('22 Rue Duperré');
        $court->setTown('Paris');
        $court->setPicture('duperré.jpg');
        $court->setLikeNumber(259);
        $this->addReference('court_1', $court);
        $manager->persist($court);
        $manager->flush();

        $court = new Court();
        $court->setName('Playground Paris 14');
        $court->setAddress('14 rue Paturle, 14e');
        $court->setTown('Paris');
        $court->setPicture('Paris14.jpg');
        $court->setLikeNumber(127);
        $manager->persist($court);
        $manager->flush();
    }

}
