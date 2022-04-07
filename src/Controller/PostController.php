<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    // Exercice : créer la fonction qui va modifier un post 
    // (dans le fichier post_form.html.twig, vous pouvez utiliser la fonction form(postForm))

    /**
     * @Route("update/post/{id}", name="post_update")
     */
    public function postUpdate(
        $id,
        PostRepository $postRepository,
        EntityManagerInterface $entityManagerInterface,
        Request $request
    ) {

        $post = $postRepository->find($id);

        $postForm = $this->createForm(PostType::class, $post);

        $postForm->handleRequest($request);

        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $entityManagerInterface->persist($post);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('post_list');
        }

        return $this->render("post_form.html.twig", ['postForm' => $postForm->createView()]);
    }

    /**
     * @Route("create/post", name="post_create")
     */
    public function postCreate(
        EntityManagerInterface $entityManagerInterface,
        Request $request
    ) {
        $post = new Post();

        $postForm = $this->createForm(PostType::class, $post);

        $postForm->handleRequest($request);

        if ($postForm->isSubmitted() && $postForm->isValid()) {
            $entityManagerInterface->persist($post);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('post_list');
        }

        return $this->render("post_form.html.twig", ['postForm' => $postForm->createView()]);
    }
}
