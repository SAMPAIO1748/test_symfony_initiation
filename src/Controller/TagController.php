<?php

namespace App\Controller;

use App\Form\TagType;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TagController extends AbstractController
{
    /**
     * @Route("/tag", name="app_tag")
     */
    public function index(): Response
    {
        return $this->render('tag/index.html.twig', [
            'controller_name' => 'TagController',
        ]);
    }

    /**
     * @Route("/tags", name="tag_list")
     */
    public function tagList(TagRepository $tagRepository)
    {
        $tags = $tagRepository->findAll();

        return $this->render("tags_list.html.twig", ['tags' => $tags]);
    }

    /**
     * @Route("tag/{id}", name="tag_show")
     */
    public function tagShow(TagRepository $tagRepository, $id)
    {
        $tag = $tagRepository->find($id);

        return $this->render("tag_show.html.twig", ['tag' => $tag]);
    }

    /**
     * @Route("update/tag/{id}", name="update_tag")
     */
    public function updateTag(
        $id,
        TagRepository $tagRepository,
        EntityManagerInterface $entityManagerInterface,
        Request $request
    ) {

        $tag = $tagRepository->find($id);

        $tagForm = $this->createForm(TagType::class, $tag);

        $tagForm->handleRequest($request);

        if ($tagForm->isSubmitted() && $tagForm->isValid()) {
            $entityManagerInterface->persist($tag);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('tag_list');
        }

        return $this->render("tag_form.html.twig", ['tagForm' => $tagForm->createView()]);
    }
}
