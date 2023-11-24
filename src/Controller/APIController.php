<?php

namespace App\Controller;

use App\Service\CallApiService;
use OpenAI;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    #[Route('/api2', name: 'app_a_p_i')]
    public function index(CallApiService $apiService): Response
    {
        $result = $apiService->getDayData();
        $key = array_keys($result);
        //print_r($key);

        /*$result = $client->chat()->create([
            'model' => 'tts-1',
            'messages' => [
                ['role' => 'user', 'content' => 'Hello!'],
            ],
        ]);

        echo $result->choices[0]->message->content; // Hello! How can I assist you today?
        */
        //print_r($result['2023-01-01']);
        //dd($result);

        return $this->render('user/Mail.html.twig', [
            'results'=>json_encode($key)
        ]);
    }
}
