<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticlesController extends AbstractController
{

    /**
     * @Route("/admin/articles", name="admin_list_articles")
     */

    public function listArticles(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();



        return $this->render('admin_articles.html.twig', [
            'articles' => $articles
        ]);
    }


    //je cree mon chemin pour admin
    /**
     * @Route("/admin/articles/insert", name="admin_insert_article")
     */
    // je cree ma method ou je utilise entitymanager ( monsieur qui gere tout mes entites) on fait autowire ( que pour les class comme ca on cree pas new etc ) EntityManagerInterface $entityManager
    public function adminArticleInsert(
        EntityManagerInterface $entityManager,
        Request $request,
        SluggerInterface $slugger)
    {
        // je cree variable pour stocke entity article ( pour l'instant vide)
        $article = new Article();
        // je recouper formu gabarit de formulaire article et je le relie avec ma nouvelle variable
        $formArticle = $this->createForm(ArticleType::class, $article);

        // je recouper les donne qui etait ecrit dans formulaire grace a class handlerequest et donne recoupere de formulaire je met dans ma variable
        $formArticle->handleRequest($request);
        // je verifie si mon requete est bien passe bien envoye et si les donne corresponde
        if ($formArticle->isSubmitted() && $formArticle->isValid()) {
            // je recouper tout les donne dans formArticle et je les stock dans variable dans entite article

            $imageFile = $formArticle->get('image')->getData();

            if ($imageFile) {
                $originalImagename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalImagename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();


                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $article->setImage($newFilename);
            }

            $article = $formArticle->getData();

            // je enregistre mon variable entity article dans la bdd
            $entityManager->persist($article);
            $entityManager->flush();
        }

        // je recoup et compile fichier twig et je le envoi au formulaire , quand twig ne sais pas affiche formulaire direct faut le passe par la methode createView
        return $this-> render("admin_insert_articles.html.twig", [
            'formArticleView' => $formArticle->createView()
        ]);






        // je cree nouveau objet article
        //$articles = new Article();
        //$articles->setTitle("Ej kej ej chlpata rit");
        //$articles->setContent("dans le ej kej ej on peut trouve les trou du cou poillue");
        //$articles->setCreatedAt(new \DateTime("NOW"));
        //$articles->setImage("hedahbdhba");
        //$articles->setIsPublished(1);

        // je passe mon article dans entitymanager  je fait operation persist ( je rendre un entite persistante aucun idee se que c'est mot persistant Cette méthode signale à Doctrine que l'objet doit être enregistré. Elle ne doit être utilisée que pour un nouvel objet et non pas pour une mise à jour.)
        //  et apres entitymanager le  fluche Met à jour la base à partir des objets signalés à Doctrine. Tant qu'elle n'est pas appellée, rien n'est modifié en base.
        //$entityManager->persist($articles);
        //$entityManager->flush($articles);

        //return $this-> render("admin_insert_articles.html.twig");

    }

    /**
     * @Route("/admin/articles/update/{id}", name="admin_update_article")
     */
    public function updateArticles(EntityManagerInterface $entityManager,
                                   ArticleRepository $articleRepository,
                                   $id,
                                   Request $request)
    {
        $article = $articleRepository->find($id);

        // je recouper formu gabarit de formulaire article et je le relie avec ma nouvelle variable
        $formArticle = $this->createForm(ArticleType::class, $article);

        // je recouper les donne qui etait ecrit dans formulaire grace a class handlerequest et donne recoupere de formulaire je met dans ma variable
        $formArticle->handleRequest($request);
        // je verifie si mon requete est bien passe bien envoye et si les donne corresponde
        if ($formArticle->isSubmitted() && $formArticle->isValid()) {
            // je recouper tout les donne dans formArticle et je les stock dans variable dans entite article
            $article = $formArticle->getData();

            // je enregistre mon variable entity article dans la bdd
            $entityManager->persist($article);
            $entityManager->flush();
        }

        // je recoup et compile fichier twig et je le envoi au formulaire , quand twig ne sais pas affiche formulaire direct faut le passe par la methode createView
        return $this-> render("admin_insert_articles.html.twig", [
            'formArticleView' => $formArticle->createView()
        ]);






        //$article = $articleRepository->find($id);

        //$article->setTitle("Super sport floorball");
        //$article->setContent("Sport dans le halle qui est similaire au hockey sur glace");

        //$entityManager->flush($article);

        //return $this-> render("admin_update_articles.html.twig");

    }

    /**
     * @Route("/admin/articles/delete/{id}", name="admin_delete_article")
     */
    public function deleteArticles(EntityManagerInterface $entityManager, ArticleRepository $articleRepository, $id)
    {
        $article = $articleRepository->find($id);

        $entityManager->remove($article);
        $entityManager->flush($article);

        // ajouter un flash message par addFlash methode qui est cree (est dedans deja) par ArticleRepository
        $this->addFlash('success', 'Votre article '.$article->getTitle().' etais bien supprime');

        // redirect faut utiliser le name de route
        return $this->redirectToRoute('admin_list_articles');




        //return $this-> render("admin_delete_articles.html.twig");

    }



}