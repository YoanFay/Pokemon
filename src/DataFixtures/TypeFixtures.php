<?php

namespace App\DataFixtures;

use App\Entity\Type;
use App\Entity\TypeEfficiency;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i <= 18; $i++) {

            $apiUrl = 'https://pokeapi.co/api/v2/type/'.$i;

            $curl = curl_init($apiUrl);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Récupérer la réponse dans une variable au lieu de l'afficher
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Ignorer la vérification SSL (attention en production)
            $response = curl_exec($curl);

            if ($response === false) {
                echo 'Erreur cURL : '.curl_error($curl);
                $data = null;
            } else {
                $data = json_decode($response, true);
            }

            curl_close($curl);

            $typeName = null;

            foreach ($data['names'] as $name) {
                if ($name['language']['name'] === "fr") {
                    $typeName = $name['name'];
                    break;
                }
            }

            $type = new Type();
            $type->setName($typeName);
            $type->setNumber($data['id']);
            $this->addReference('type-'.$data['id'], $type);
            $manager->persist($type);
            $manager->flush();
        }

    }
}
