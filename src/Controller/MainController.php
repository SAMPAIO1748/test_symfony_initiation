<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    // exercice créer une route qui va afficher "bienvenuesur notre site"


}
