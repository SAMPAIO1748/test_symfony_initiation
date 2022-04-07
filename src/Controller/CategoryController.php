<?php

namespace App\Controller;

use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("update/category/{id}", name="category_update")
     */
    public function categoryUpdate(
        $id,
        CategoryRepository $categoryRepository,
        EntityManagerInterface $entityManagerInterface,
        Request $request
    ) {
        $category = $categoryRepository->find($id);

        // Création du formulaire
        $categoryForm = $this->createForm(CategoryType::class, $category);

        // HandleRequest permet de récupérer les informations rentrées dans le formulaire
        // et de les traiter
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            // la fonction persist va regarder ce que l'on a fait sur category et
            // réaliser le code pour faire le CREATE ou le UPDATE en fonction de l'origine de la category  
            $entityManagerInterface->persist($category);
            // la fonction flush enregistre dans la bdd.
            $entityManagerInterface->flush();

            return $this->redirectToRoute('category_list');
        }

        return $this->render('category_form.html.twig', ['categoryForm' => $categoryForm->createView()]);
    }

    // exerice créer une méthode qui modifie le name d'un tag en fonction de son id et le name sera :
    // nouveau tag modifié
}
