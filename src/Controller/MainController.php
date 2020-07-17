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
       // $response = $client->request('GET', 'https://api.jikan.moe/v3/anime/1/');

            for($i = 1; $i<=5; $i++)
            {
                $response = $client->request('GET', 'https://api.jikan.moe/v3/anime/'. $i . '/');
                if(!empty($response)){
                    $content = $response->toArray();
                    return $this->render('main/index.html.twig', [
                        'animes' => $content,
                    ]); 
                }
            }
       
        // gets the HTTP status code of the response
        //$statusCode = $response->getStatusCode();

        // gets the HTTP headers as string[][] with the header names lower-cased
        //$headers = $response->getHeaders();
        
        // Récupérer le type de content : 'application/json'
        //$contentType = $response->getHeaders()['content-type'][0];
        
        // gets the response body as a string
        //$content = $response->getContent();
        
        // casts the response JSON contents to a PHP array
        //$content = $response->toArray();
        
        //$tableauPHP = ['prenom'=>'nicolas', 'nom'=>'LEPETIT'];
        //return $this->render('main/index.html.twig', [
        //    'anime' => $content,
        //    'auteur'=>$tableauPHP,
        //]);
    }

    // /**
    //  * @Route("/", name="app_home", methods={"GET"})
    //  */
    // public function Manga(HttpClientInterface $client)
    // {      
    //    // $response = $client->request('GET', 'https://api.jikan.moe/v3/anime/1/');

    //         for($j = 1; $j<=5; $j++)
    //         {
    //             $response2 = $client->request('GET', 'https://api.jikan.moe/v3/manga/'. $j . '/');
    //             if(!empty($response2)){
    //                 $content2 = $response2->toArray();
    //                 return $this->render('main/index.html.twig', [
    //                     'mangas' => $content2,
    //                 ]); 
    //             }
    //         }
    // }
}
