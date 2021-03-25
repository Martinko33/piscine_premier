<?php


namespace App\Controller\Admin;


use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/admin/categories", name="admin_list_categories")
     */
    public function adminListCategory(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('admin_categories.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/admin/categories/insert", name="admin_categories_insert")
     */
    public function adminCategoriesInsert(Request $request, EntityManagerInterface $entityManager)
    {
        $category = new Category();

        $categoryForm = $this->createForm(CategoryType::class, $category);

        $categoryForm->handleRequest($request);
        if($categoryForm->isSubmitted() && $categoryForm->isValid())
        {
            $category = $categoryForm->getData();

            $entityManager->persist($category);
            $entityManager->flush();
        }
        return $this->render("admin_insert_categories.html.twig", [
            'formCategoryView' => $categoryForm->createView()

        ]);

    }

    /**
     * @Route("/admin/categories/update/{id}", name="admin_categories_update")
     */
    public function adminCategoriesUpdate(CategoryRepository $categoryRepository,
                                          $id,
                                          Request $request,
                                          EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);

        $categoryForm = $this->createForm(CategoryType::class, $category);

        $categoryForm->handleRequest($request);
        if($categoryForm->isSubmitted() && $categoryForm->isValid())
        {
            $category = $categoryForm->getData();

            $entityManager->persist($category);
            $entityManager->flush();
        }
        return $this->render("admin_insert_categories.html.twig", [
            'formCategoryView' => $categoryForm->createView()

        ]);
    }

    /**
     * @Route("/admin/categories/detele/{id}", name="admin_categories_delete")
     */
    public function adminCategorieDelete($id,
                                         CategoryRepository $categoryRepository,
                                         EntityManagerInterface $entityManager)
    {
        $category = $categoryRepository->find($id);

        $entityManager->remove($category);
        $entityManager->flush($category);


        return $this->redirectToRoute('admin_list_categories');
    }
}