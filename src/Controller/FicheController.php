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
            $content=[];
            $response = $client->request('GET', 'https://api.jikan.moe/v3/anime/'. $id);
            if($response->getStatusCode() === 200) {
                if(!empty($response)){
                    $content = $response->toArray();
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
