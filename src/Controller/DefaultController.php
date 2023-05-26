<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(HttpClientInterface $client): Response
    {
        $chiffre = [1,2,3,4,5];
        $random = array_rand($chiffre);

        $response = $client->request(
            'GET',
           // 'https://euw1.api.riotgames.com/lol/summoner/v4/summoners/by-name/Chaise%20Roulante?api_key=RGAPI-26bba2c8-eb59-4995-a030-b45b0ceb178b'
            'http://ddragon.leagueoflegends.com/cdn/13.10.1/data/en_US/champion/DrMundo.json'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'

        $content = $response->toArray();



        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $this->render('index.html.twig', [
            'website' => 'Wild Series',
            'content' => $content,
            'random' => $random,
        ]);
    }

}