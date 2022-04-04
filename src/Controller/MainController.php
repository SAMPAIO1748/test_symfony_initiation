<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        var_dump("home");
        die;
    }

    // #[Route('/home', name: 'home')]
    // écriture des routes sous Symfony 6.

    // exercice créer une route qui va afficher "bienvenue sur notre site"

    /**
     * @Route("/welcome", name="welcome")
     */
    public function welcome()
    {
        var_dump("bienvenue sur notre site");
        die;
    }

    /**
     * @Route("legal", name="mentions_legales")
     */
    public function mentionsLegales()
    {
        return new Response("Voici les mentions légales du site.");
    }

    // exo : faire une page a propos à l'aide d'une Response pour afficher "Voic les informations concernant le site"
}
