<?php


namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="list_categorie")
     */

    public function listCategories(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render("categories.html.twig" ,[
            "categories" => $categories

        ]);





    }

}