<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {

        $apiUrl = 'https://pokeapi.co/api/v2/pokemon/ditto';

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

        return $this->render('homepage/index.html.twig', [
            'data' => $data
        ]);
    }
}
