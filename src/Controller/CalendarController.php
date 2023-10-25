<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Repository\TacheRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/', name: 'app_calendar',methods: ['GET'])]
    public function index(TacheRepository $tacheRepository):Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $travaux = $tacheRepository->findByUser($user);

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
             $title = $t->getNom();
             $start = $t->getDebut()->format('Y-m-d H:i:s');
             $end = $t->getFin()->format('Y-m-d H:i:s');
             $description = $t->getDescription();
             $color = $t->getBackgroundColor();
             $id = $t->getId();
        }
        $data = json_encode($dvrs);
        /*$type = gettype($dvrs);
        echo  "###############################################";
        echo "Le type de la variable est : " . $type;
        dd($data);
        //dd($travaux);*/

        return $this->render('calendar/index.html.twig', [
            'data'=>($data),
            'title'=> json_encode($title),
            'start' => json_encode($start),
            'end' => json_encode($end),
            'description' => json_encode($description),
            'color' => json_encode($color),
            'id' => json_encode($id)
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
