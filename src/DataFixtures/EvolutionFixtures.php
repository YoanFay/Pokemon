<?php

namespace App\DataFixtures;

use App\Entity\Evolution;
use App\Entity\Generation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EvolutionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 1; $i <= 538; $i++) {
            $apiUrl = 'https://pokeapi.co/api/v2/evolution-chain/'.$i;

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

            if ($data) {
                $base = $this->getReference('pokemon-'.str_replace(['https://pokeapi.co/api/v2/pokemon-species/', '/'], ['', ''], $data['chain']['species']['url']));

                foreach ($data['chain']['evolves_to'] as $evolveTo) {

                    $secondPokemon = $this->getReference('pokemon-'.str_replace(['https://pokeapi.co/api/v2/pokemon-species/', '/'], ['', ''], $evolveTo['species']['url']));

                    foreach ($evolveTo['evolution_details'] as $detail) {

                        $evolution = new Evolution();

                        $evolution->setBasePokemon($base);
                        $evolution->setEvolutionPokemon($secondPokemon);
                        $evolution->setWeatherCondition($detail['needs_overworld_rain']);
                        if ($detail['item']) {
                            $evolution->setUseObject($detail['item']['name']);
                        }
                        if ($detail['held_item']) {
                            $evolution->setHoldObject($detail['held_item']['name']);
                        }
                        $evolution->setLevel($detail['min_level']);
                        if ($detail['location']) {
                            $evolution->setLocation($detail['location']['name']);
                        }
                        if ($detail['min_happiness']) {
                            $evolution->setHappiness(true);
                        } else {
                            $evolution->setHappiness(false);
                        }
                        if ($detail['time_of_day'] !== "") {
                            $evolution->setHour($detail['time_of_day']);
                        }
                        if ($detail['gender'] === 1) {
                            $evolution->setGender('Female');
                        } else if ($detail['gender'] === 2) {
                            $evolution->setGender('Male');
                        }
                        if ($detail['known_move']) {
                            $evolution->setHour($detail['known_move']['name']);
                        }

                        $manager->persist($evolution);
                        $manager->flush();
                    }

                    foreach ($evolveTo['evolves_to'] as $evolveTo2) {

                        $lastPokemon = $this->getReference('pokemon-'.str_replace(['https://pokeapi.co/api/v2/pokemon-species/', '/'], ['', ''], $evolveTo2['species']['url']));

                        foreach ($evolveTo2['evolution_details'] as $detail) {

                            $evolution = new Evolution();

                            $evolution->setBasePokemon($secondPokemon);
                            $evolution->setEvolutionPokemon($lastPokemon);
                            $evolution->setWeatherCondition($detail['needs_overworld_rain']);
                            if ($detail['item']) {
                                $evolution->setUseObject($detail['item']['name']);
                            }
                            if ($detail['held_item']) {
                                $evolution->setHoldObject($detail['held_item']['name']);
                            }
                            $evolution->setLevel($detail['min_level']);
                            if ($detail['location']) {
                                $evolution->setLocation($detail['location']['name']);
                            }
                            if ($detail['min_happiness']) {
                                $evolution->setHappiness(true);
                            }
                            if ($detail['time_of_day'] !== "") {
                                $evolution->setHour($detail['time_of_day']);
                            }
                            if ($detail['gender'] === 1) {
                                $evolution->setGender('Female');
                            } else if ($detail['gender'] === 2) {
                                $evolution->setGender('Male');
                            }
                            if ($detail['known_move']) {
                                $evolution->setLearnAttack($detail['known_move']['name']);
                            }
                            if ($detail['known_move_type']) {
                                $evolution->setLearnAttackType($this->getReference('type-'.str_replace(['https://pokeapi.co/api/v2/type/', '/'], ['', ''], $detail['known_move_type']['url'])));
                            }
                            if ($detail['trigger']['name'] === "trade"){
                                $evolution->setTrade(true);
                            }
                            if ($detail['party_type']) {
                                $evolution->setPartyType($this->getReference('type-'.str_replace(['https://pokeapi.co/api/v2/type/', '/'], ['', ''], $detail['party_type']['url'])));
                            }
                            if ($detail['party_species']) {
                                $evolution->setPartyType($this->getReference('pokemon-'.str_replace(['https://pokeapi.co/api/v2/pokemon-species/', '/'], ['', ''], $detail['party_species']['url'])));
                            }

                            switch ($detail['relative_physical_stats']){
                            case 1 :
                                $evolution->setStats("Attack > Defense");
                                break;
                            case 0 :
                                $evolution->setStats("Attack = Defense");
                                break;
                            case -1 :
                                $evolution->setStats("Attack < Defense");
                                break;
                            }

                            $manager->persist($evolution);
                            $manager->flush();
                        }
                    }
                }
            }
        }
    }


    public function getDependencies(): array
    {

        return array(
            PokemonFixtures::class,
        );
    }
}
