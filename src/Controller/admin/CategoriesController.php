<?php


namespace App\Controller\Admin;


use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * route pour class comme ca je doit pas repete la admin/categories dans autre Route
 * @Route("/admin/categories")
 */
class CategoriesController extends AbstractController
{
    /**
     * @Route("/", name="admin_list_categories")
     *
     */
    public function adminListCategory(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->findAll();

        return $this->render('admin_categories.html.twig', [
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/insert", name="admin_categories_insert")
     */
    public function adminCategoriesInsert(
        Request $request,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger)
    {
        $category = new Category();

        $categoryForm = $this->createForm(CategoryType::class, $category);

        $categoryForm->handleRequest($request);
        if($categoryForm->isSubmitted() && $categoryForm->isValid())
        {
            // je recouper image de url get par getData et je le stock en imageFile
            $imageFile = $categoryForm->get('image')->getData();
            // je fais if car si j'ai pas bien recouper image ca ne serre a rien continue
            if ($imageFile) {
                // je recouper donne de imageFile et avec getCleinetOriginal je recouper nom de fichier( image) et avec pathinfo je recouper chemin ou mon fichier est stocker terporerment
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // slug c'est pour bien verifier caracter bizare dans nom de fichier pour que symfony ou twig je ne sais pas ne reste pas bloque
                $safeFilename = $slugger->slug($originalFilename);
                // je cree ma variable dans quelle je vais stocker nom fichier verifie avec son id cree automatiquement et ca extension fichier ( image.jpg
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                // je bouge mon fichier dans dossier upload move c'est la methode et je le verifie par la methode getParametre
                // dans le config/service.yaml faut ajouter dans parameters image_directory: '%kernel etc check doc https://symfony.com/doc/current/controller/upload_file.html
                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                    // si try ne marche pas et mon fichier se upload pas je fait catch ,je peux afficher aussi la message
                } catch (FileException $e) {
                    //
                }

                // la je recouper par setter mes donne de newFilename et je les stock dans variable category
                $category->setImage($newFilename);
            }
            $category = $categoryForm->getData();

            $entityManager->persist($category);
            $entityManager->flush();
        }
        return $this->render("admin_insert_categories.html.twig", [
            'formCategoryView' => $categoryForm->createView()

        ]);

    }

    /**
     * @Route("/update/{id}", name="admin_categories_update")
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
     * @Route("/detele/{id}", name="admin_categories_delete")
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