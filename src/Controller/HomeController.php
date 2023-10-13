<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    // // #[Route('/home', name: 'app_home')]
    // Architecture MVC
    // 1- Envoyer une requete http en saisisant les données à partir de l'URL d'un navigateur 
    // 2- Récupérer la requete http par le 'controleur' (controller) 
    // 3- si besoin le controleur appelle le 'model' et envoi la requete vers le model afin d'interagir avec la bdd
    // 4- Le model envoie la reponse au controleur
    // 5-Controleur récupère la réponse du model et il l'envoie vers la 'vue'(view)

    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
