<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    #[Route('/api', name: 'app_a_p_i')]
    public function index(CallApiService $apiService): Response
    {
        $result = $apiService->getDayData();
        $key = array_keys($result);
        //print_r($key);

        //print_r($result['2023-01-01']);
        //dd($result);

        return $this->render('api/index.html.twig', [
            'controller_name' => 'APIController',
            'results'=>json_encode($key)
        ]);
    }
}
