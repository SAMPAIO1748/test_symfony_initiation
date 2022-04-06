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
     */                         // autowire ou autowirering
    public function postList(PostRepository $postRepository)
    {
        // la méthode findAll récupère tous les posts de la base de données.
        $posts = $postRepository->findAll();

        return $this->render("post_list.html.twig", ['posts' => $posts]);
    }

    /**
     * @Route("post/{id}", name="post_show")
     */
    public function postShow($id, PostRepository $postRepository)
    {
        // la méthode find permet de récuperer un post en focntion de son id
        $post = $postRepository->find($id);

        return $this->render("post_show.html.twig", ['post' => $post]);
    }
}
