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

    // exo : faire une page a propos à l'aide d'une Response pour afficher "Voici les informations concernant le site"

    /**
     * @Route("about", name="about")
     */
    public function about()
    {
        return new Response("Voici les informations concernant le site");
    }

    /**                //wildcard : permet de mettre des paramètres dans l'URL (paramètres GET)
     * @Route("number/{id}", name="number")
     */
    public function number($id)
    {
        return new Response($id);
    }

    // exo : créer une route qui va afficher "Mon age est de : {valeur de l'age} ". La valeur de l'âge est donnée par la wildcard.

    /**
     * @Route("age/{age}", name="age")
     */
    public function age($age)
    {
        return new Response("Mon âge est de : " . $age . " ans.");
    }

    /*$tableau_articles = [
        1 => [
            "titre" => "Vive la Bretagne",
            "contenu" => "La Bretagne c'est fantastique",
            "id" => 1
        ],
        2 => [
            "titre" => "Vive la Normandie",
            "contenu" => "La Normandie c'est magnifique",
            "id" => 2,
        ],
        3 => [
            "titre" => "Vive la Guyane",
            "contenu" => "La Guyane c'est merveilleux",
            "id" => 3

        ]
    ]

    Exercice : créer une route et une fonction qui va afficher le titre de l'article qui sera selectionné par la wildcard
    */

    /**
     * @Route("/array/article/{id}", name="array_article")
     */
    public function arrayArticle($id)
    {

        $tableau_articles = [
            1 => [
                "titre" => "Vive la Bretagne",
                "contenu" => "La Bretagne c'est fantastique",
                "id" => 1
            ],
            2 => [
                "titre" => "Vive la Normandie",
                "contenu" => "La Normandie c'est magnifique",
                "id" => 2,
            ],
            3 => [
                "titre" => "Vive la Guyane",
                "contenu" => "La Guyane c'est merveilleux",
                "id" => 3

            ]
        ];

        if (array_key_exists($id, $tableau_articles)) {
            return new Response("Le titre de l'article est : " . $tableau_articles[$id]["titre"]);
        } else {
            return new Response("L'article n'existe pas !");
        }
    }

    // Exercice : creer une route play avec une wildcard 'age', si age est inféieur à 18 alors il affiche "Vous avez "age" ans. 
    //Vous ne pouvez pas jouer au poker.". Si l'age est supérieur à 18 alors il affiche "Vous avez "age" ans. Vous pouver jouer au poker".

    /**
     * @Route("play/{age}", name="play")
     */
    public function play($age)
    {
        if ($age >= 18) {
            return new Response("Vous avez " . $age . " ans. Vous pouvez jouer au poker.");
        } else {
            return new Response("Vous avez " . $age . " ans. Vous ne pouvez pas jouer au poker.");
        }
    }

    /**
     * @Route("bienvenue", name="bienvenue")
     */
    public function bienvenue()
    {
        // la méthode redirectToRoute est une méthode qui vient de l'AbstractController qui redirige vers une route créer dans un controller.
        return $this->redirectToRoute('welcome');
    }

    // Exercice : créer la route poker avec une wildcard . Cette fois ci si l'age est inférieur à 18, on redirige vers une route enfant qui
    // affiche : "Vous avez "age" ans. Vous ne pouvez pas jouer au poker." . Si l'age est supérieur ou égal à 18, on redirige vers la route adulte
    // qui affiche: "Vous avez "age" ans. Vous pouver jouer au poker".
}
