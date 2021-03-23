<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
    // je cree ma method ou je utilise entitymanager ( monsieur qui gere tout mes entites) on fait autowire EntityManagerInterface $entityManager
    public function adminArticleInsert(EntityManagerInterface $entityManager)
    {

        // je cree nouveau objet article
        $articles = new Article();
        $articles->setTitle("Ej kej ej chlpata rit");
        $articles->setContent("dans le ej kej ej on peut trouve les trou du cou poillue");
        $articles->setCreatedAt(new \DateTime("NOW"));
        $articles->setImage("hedahbdhba");
        $articles->setIsPublished(1);

        // je passe mon article dans entitymanager  je fait operation persist ( je rendre un entite persistante aucun idee se que c'est mot persistant Cette méthode signale à Doctrine que l'objet doit être enregistré. Elle ne doit être utilisée que pour un nouvel objet et non pas pour une mise à jour.)
        //  et apres entitymanager le  fluche Met à jour la base à partir des objets signalés à Doctrine. Tant qu'elle n'est pas appellée, rien n'est modifié en base.
        $entityManager->persist($articles);
        $entityManager->flush($articles);

        return $this-> render("admin_insert_articles.html.twig");

    }

    /**
     * @Route("/admin/articles/update/{id}", name="admin_update_article")
     */
    public function updateArticles(EntityManagerInterface $entityManager, ArticleRepository $articleRepository, $id)
    {
        $article = $articleRepository->find($id);

        $article->setTitle("Super sport floorball");
        $article->setContent("Sport dans le halle qui est similaire au hockey sur glace");

        $entityManager->flush($article);

        return $this-> render("admin_update_articles.html.twig");

    }

    /**
     * @Route("/admin/articles/delete/{id}", name="admin_delete_article")
     */
    public function deleteArticles(EntityManagerInterface $entityManager, ArticleRepository $articleRepository, $id)
    {
        $article = $articleRepository->find($id);

        $entityManager->remove($article);
        $entityManager->flush($article);

        $articles = $articleRepository->findAll();

        return $this->render('admin_articles.html.twig', [
            'articles' => $articles
        ]);

        //return $this-> render("admin_delete_articles.html.twig");

    }



}