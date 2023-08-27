<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use App\Entity\PokemonType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PokemonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {


        for ($i = 1; $i <= 1010; $i++) {
            $apiUrl = 'https://pokeapi.co/api/v2/pokemon-species/'.$i;

            $curl = curl_init($apiUrl);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Récupérer la réponse dans une variable au lieu de l'afficher
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Ignorer la vérification SSL (attention en production)
            $response = curl_exec($curl);

            if ($response === false) {
                echo 'Erreur cURL : '.curl_error($curl);
            } else {
                $data = json_decode($response, true);
            }

            curl_close($curl);

            $apiUrl = 'https://pokeapi.co/api/v2/pokemon/'.$i;

            $curl = curl_init($apiUrl);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Récupérer la réponse dans une variable au lieu de l'afficher
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // Ignorer la vérification SSL (attention en production)
            $response = curl_exec($curl);

            if ($response === false) {
                echo 'Erreur cURL : '.curl_error($curl);
            } else {
                $data2 = json_decode($response, true);
            }

            curl_close($curl);

            foreach ($data['names'] as $name) {
                if ($name['language']['name'] === "fr") {
                    $pokemonName = $name['name'];
                    break;
                }
            }

            if (!isset($pokemonName)) {
                foreach ($data['names'] as $name) {
                    if ($name['language']['name'] === "en") {
                        $pokemonName = $name['name'];
                        break;
                    }
                }
            }

            foreach ($data['genera'] as $category) {
                if ($category['language']['name'] === "fr") {
                    $pokemonCategory = $category['genus'];
                    break;
                }
            }

            if (!isset($pokemonCategory)) {
                foreach ($data['genera'] as $category) {
                    if ($category['language']['name'] === "en") {
                        $pokemonCategory = $category['genus'];
                        break;
                    }
                }
            }

            switch ($data['color']['name']) {
            case 'black':
                $color = 'Noir';
                break;
            case 'blue':
                $color = 'Bleu';
                break;
            case 'brown':
                $color = 'Brun';
                break;
            case 'gray':
                $color = 'Gris';
                break;
            case 'green':
                $color = 'Vert';
                break;
            case 'pink':
                $color = 'Rose';
                break;
            case 'purple':
                $color = 'Violet';
                break;
            case 'red':
                $color = 'Rouge';
                break;
            case 'white':
                $color = 'Blanc';
                break;
            case 'yellow':
                $color = 'Jaune';
                break;
            }

            $pokemon = new Pokemon();

            $pokemon->setGeneration($this->getReference($data['generation']['name']));
            $pokemon->setName($pokemonName);
            $pokemon->setNameEn(ucfirst($data['name']));
            $pokemon->setCategory($pokemonCategory);
            $pokemon->setSize($data2['height'] / 10);
            $pokemon->setWeight($data2['weight'] / 10);
            $pokemon->setHatchingCycle($data['hatch_counter'] - 1);
            $pokemon->setHatchingStep(256 * $data['hatch_counter']);
            $pokemon->setExpCurve($data['growth_rate']['name']);
            if ($data['gender_rate'] === -1) {
                $pokemon->setMaleRate(0);
                $pokemon->setFemaleRate(0);
            } else {
                $pokemon->setMaleRate(100 - (($data['gender_rate'] / 8) * 100));
                $pokemon->setFemaleRate(($data['gender_rate'] / 8) * 100);
            }
            $pokemon->setCaptureRate($data['capture_rate']);
            $pokemon->setColor($color);
            $pokemon->setNationalNumber($data['id']);

            $this->addReference('pokemon-'.$data['id'], $pokemon);

            $manager->persist($pokemon);

            foreach ($data2['types'] as $type) {
                $relation = new PokemonType();
                $relation->setPokemon($pokemon);
                $relation->setType($this->getReference('type-'.str_replace(['https://pokeapi.co/api/v2/type/', '/'], ['', ''], $type['type']['url'])));
                $relation->setSlot($type['slot']);

                $manager->persist($relation);
            }

            $manager->flush();
        }
    }


    public function getDependencies(): array
    {

        return array(
            TypeFixtures::class,
            GenerationFixtures::class,
        );
    }
}
