<?php

namespace App\Controller;

use App\Repository\PokemonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{
    /**
     * @Route("/pokemon/{nationalNumber}", name="pokemon_index")
     */
    public function index(
        PokemonRepository $pokemonRepository,
        $nationalNumber
    ): Response
    {
        $pokemon = $pokemonRepository->findOneBy(['national_number' => $nationalNumber]);

        return $this->render('pokemon/index.html.twig', [
            'pokemon' => $pokemon,
        ]);
    }
}
