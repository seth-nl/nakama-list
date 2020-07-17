<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FicheMangaController extends AbstractController
{
    /**
     * @Route("/fiche/manga/{id}", name="app_fiche_manga")
     */
    public function index(HttpClientInterface $client, $id)
    {
        $content=[];
        $response = $client->request('GET', 'https://api.jikan.moe/v3/manga/'. $id);
        if($response->getStatusCode() === 200) {
            if(!empty($response)){
                $content = $response->toArray();
            }
        }
        return $this->render('fiche_manga/index.html.twig', [
            'fiche' => $content,
        ]);
    }
}
