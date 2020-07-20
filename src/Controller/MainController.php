<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/", name="app_home", methods={"GET"})
     */
    public function Anime(HttpClientInterface $client)
    {      
            $content=[];
            for($i = 0; $i <= 37; ++$i)
            {
                $response = $client->request('GET', 'https://api.jikan.moe/v3/anime/'. $i);
                //dd($response->toArray());
                if($response->getStatusCode() === 200) {
                    if(!empty($response)){
                        $content[$i] = $response->toArray();
                    }
                    if(count($content) == 5){
                        $i = 37;
                    }
                }
            }

            $content2=[];
            for($j = 1; $j <= 37; ++$j)
            {
                $response2 = $client->request('GET', 'https://api.jikan.moe/v3/manga/'. $j);
                if($response2->getStatusCode() === 200) {
                    if(!empty($response2)){
                        $content2[$j] = $response2->toArray();
                    }
                    if(count($content2) == 5){
                        $j = 37;
                    }
                }
            }
            return $this->render('main/index.html.twig', [
                'animes' => $content,
                'mangas' => $content2
            ]); 
    }
}
