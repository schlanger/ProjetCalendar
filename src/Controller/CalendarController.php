<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Repository\TacheRepository;
use App\Service\CallApiService;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{

    #[Route('/', name: 'app_calendar',methods: ['GET'])]
    public function index(TacheRepository $tacheRepository,CallApiService $apiService):Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        //dd($apiService->getDayData());

        $travaux = $tacheRepository->findByUser($user);
        $tache = new Tache();
        $dvrs = [];
        foreach($travaux as $t){
            /*$nom = $t->getNom();
            $description = $t->getDescription();
            $debut = $t->getDebut()->format('Y-m-d H:i:s');
            $fin = $t->getFin()->format('Y-m-d H:i:s');
            $background = $t->getBackgroundColor();
            $journee = $t->getToutelaJournee();*/
            $dvrs[] = [
                'id' => $t->getId(),
                'nom'=> $t->getNom(),
                'description'=> $t->getDescription(),
                'debut' => $t->getDebut()->format('Y-m-d H:i:s'),
                'fin' => $t->getFin()->format('Y-m-d H:i:s'),
                'color' => $t->getBackgroundColor(),
                'journee' => $t->getToutelaJournee()
            ];}
             foreach($travaux as $t){
             $color = $t->getBackgroundColor();
             $id = $t->getId();
        }
        $data = json_encode($dvrs);
        /*$type = gettype($dvrs);
        echo  "###############################################";
        echo "Le type de la variable est : " . $type;
        dd($data);
        //dd($travaux);*/
        $result = $apiService->getDayData();
        $key = array_keys($result);
        $value = array_values($result);

        return $this->render('calendar/index.html.twig', [
            'taches' => $tacheRepository->findByUser($user),
            'data'=>($data),
            'color' => json_encode($color),
            'id'=> $id,
            'JoursFeries'=> json_encode($key[0]),
            'value'=> json_encode($value[0]),
            'paques'=> json_encode($key[1]),
            'value2' =>json_encode($value[1])
        ]);

            /*'nom'=>json_encode($nom),
            'desc' => json_encode($description),
            'debut' => json_encode($debut),
            'fin' => json_encode($fin),
            'color' => json_encode($background),
            'travail' => $travaux
            ]);*/



    }
}
