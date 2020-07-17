<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JikanController extends AbstractController
{
    /**
     * @Route("/jikan", name="jikan", methods={"GET"})
     */
    public function Jikan(HttpClientInterface $client, SerializerInterface $serializer)
    {      
        $response = $client->request('GET', 'https://api.jikan.moe/v3/anime/1/');
       
        // gets the HTTP status code of the response
        $statusCode = $response->getStatusCode();

        // gets the HTTP headers as string[][] with the header names lower-cased
        $headers = $response->getHeaders();
        
        // Récupérer le type de content : 'application/json'
        $contentType = $response->getHeaders()['content-type'][0];
        
        // gets the response body as a string
        //$content = $response->getContent();
        
        // casts the response JSON contents to a PHP array
        $content = $response->toArray();
        return $this->render('main/index.html.twig', [
            'anime' => $content,
        ]);
    }
}
