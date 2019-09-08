<?php

namespace App\DataFixtures;

use App\Entity\Division;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DivisionFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $divisionData = array(
            array('Direction', 'direction@contact.com'),
            array('Ressources humaines', 'RH@contact.com'),
            array('Communication', 'com@contact.com'),
            array('Developpement', 'dev@contact.com')
        );
        $divisionNumber = count($divisionData);
        for ($i = 0; $i < $divisionNumber; $i++) {
            $division = new Division();
            $division->setLabel($divisionData[$i][0]);
            $division->setMail($divisionData[$i][1]);
            $manager->persist($division);
        }
        $manager->flush();
    }
}
