<?php

namespace App\DataFixtures;

use App\Entity\Generation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenerationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 9; $i++){
            $generation = new Generation();
            $generation->setNumber($i);

            switch ($i){
            case 1:
                $romain = 'i';
                break;
            case 2:
                $romain = 'ii';
                break;
            case 3:
                $romain = 'iii';
                break;
            case 4:
                $romain = 'iv';
                break;
            case 5:
                $romain = 'v';
                break;
            case 6:
                $romain = 'vi';
                break;
            case 7:
                $romain = 'vii';
                break;
            case 8:
                $romain = 'viii';
                break;
            case 9:
                $romain = 'ix';
                break;
            }

            $this->addReference('generation-'.$romain, $generation);

            $manager->persist($generation);
            $manager->flush();
        }


    }
}
