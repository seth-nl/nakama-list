<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FicheController extends AbstractController
{
    /**
     * @Route("/ficheAnime/{id}", name="app_fiche_anime")
     */
    public function index(HttpClientInterface $client, $id)
    {
        // on initialise notre variable content comme un tableau
            $content=[];
            // on fait notre requête API avec la fonction request()
            $response = $client->request('GET', 'https://api.jikan.moe/v3/anime/'. $id);
            if($response->getStatusCode() === 200) {
                // on vérifie qu'il n'y a pas d'erreur
                if(!empty($response)){
                    //si le tableau n'est pas vide
                    $content = $response->toArray();
                    // on transforme notre tableau json en un tableau PHP expoitable dans notre template
                }
            }

            $content2=[];
            $response2 = $client->request('GET', 'https://api.jikan.moe/v3/anime/'. $id . '/episodes');
            //dd($response2->toArray());
            if($response2->getStatusCode() === 200) {
                if(!empty($response2)){
                    $content2 = $response2->toArray();
                }
            }
        return $this->render('ficheanime/index.html.twig', [
            'fiche' => $content,
            'episodes' => $content2,
        ]);
    }
}
