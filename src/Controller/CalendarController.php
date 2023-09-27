<?php

namespace App\Controller;

use App\Repository\TacheRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/', name: 'app_calendar',methods: ['GET'])]
    public function index(TacheRepository $tacheRepository):Response
    {
        $travaux = $tacheRepository->findAll();
        dd($travaux);
        return $this->render('calendar/index.html.twig', [
            'controller_name' => 'CalendarController',
        ]);
    }
}
