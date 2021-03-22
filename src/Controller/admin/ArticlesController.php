<?php

namespace App\Controller\admin;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    //je cree mon chemin pour admin
    /**
     * @Route ("/admin/articles/insert", name="admin_article")
     */
    // je cree ma function ou je utilise entitymanager ( monsieur qui gere tout mes entites
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

        return $this-> render("admin_articles.html.twig");

    }




}


