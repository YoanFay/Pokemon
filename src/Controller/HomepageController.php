<?php

namespace App\Controller;

use App\Repository\EvolutionRepository;
use App\Repository\PokemonRepository;
use App\Repository\PokemonTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(
        PokemonRepository $pokemonRepository,
        PokemonTypeRepository $pokemonTypeRepository,
        EvolutionRepository $evolutionRepository
    ): Response
    {

        $pokemon = $pokemonRepository->findOneBy(['national_number' => rand(1, 1010)]);

        $types = $pokemonTypeRepository->findBy(['pokemon' => $pokemon], ['slot' => 'ASC']);

        $evolutions = $evolutionRepository->findBy(['base_pokemon' => $pokemon]);

        return $this->render('homepage/index.html.twig', [
            'pokemon' => $pokemon,
            'types' => $types,
            'evolutions' => $evolutions
        ]);
    }
}
