<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="app_post")
     */
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    /**
     * @Route("posts", name="post_list")
     */                         // autowire ou autowiring
    public function postList(PostRepository $postRepository)
    {
        // la méthode findAll récupère tous les posts de la base de données.
        $posts = $postRepository->findAll();

        return $this->render("post_list.html.twig", ['posts' => $posts]);
    }
}
