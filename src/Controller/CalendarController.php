<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Repository\TacheRepository;
use App\Service\CallApiService;
use phpDocumentor\Reflection\DocBlock\Tags\Method;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{

    #[Route('/', name: 'app_calendar',methods: ['GET'])]
    public function index(TacheRepository $tacheRepository,CallApiService $apiService,MailerInterface $mailer):Response
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
        //dd($result )
        $dateActuelle = new \DateTime();
        //dd($dateActuelle->format('Y-m-d H:i:s'));

        foreach ($travaux as $t) {
            // Comparer les dates en utilisant le formatage
            if ($t->getDebut()->format('Y-m-d H:i:s') == $dateActuelle->format('Y-m-d H:i:s')) {
                $email = (new TemplatedEmail())
                    ->from(new Address('yehouda@calendar.com', 'Rappel!!'))
                    ->to($user->getEmail())
                    ->subject('Don\'t forget your Task for now')
                    ->htmlTemplate('calendar/Rappel.html.twig');

                $mailer->send($email);
            }
        }


        return $this->render('calendar/index.html.twig', [
            'taches' => $tacheRepository->findByUser($user),
            'data'=>($data),
            'JoursFeries'=> json_encode($key[0]),
            'result ' => json_encode($result),
            'value'=> json_encode($value[0]),
            'paques'=> json_encode($key[1]),
            'value2' =>json_encode($value[1]),
            'Armistice' => json_encode($key[9]),
            'Armistice2' => json_encode($value[9]),
            'Noel' => json_encode($key[10]),
            'Noel2' => json_encode($value[10])

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
