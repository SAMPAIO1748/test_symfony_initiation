<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/cateory", name="app_cateory")
     */
    public function index(): Response
    {
        return $this->render('cateory/index.html.twig', [
            'controller_name' => 'CateoryController',
        ]);
    }

    /**
     * @Route("categories", name="category_list")
     */                             // autowire
    public function categoryList(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render("categories_list.html.twig", ['categories' => $categories]);
    }

    /**
     * @Route("category/{id}", name="category_show")
     */
    public function categoryShow(CategoryRepository $categoryRepository, $id)
    {
        $category = $categoryRepository->find($id);

        return $this->render("category_show.html.twig", ['category' => $category]);
    }

    // Exercice créer les deux méthodes qui permettent d'afficher la liste des tag
    // et un tag en particulier à l'aide de son id
}
