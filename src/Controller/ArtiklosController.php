<?php

// je cree mon chemin pour ma class
namespace App\Controller;

// mes chemin (namespace) pour annotation route , methode repository ( find, findbyone, findall)
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArtiklosController extends AbstractController
{
    /**
     * @Route("/artiklos", name="list_artiklos")
     */
    //je met class articleRepository ( je la trouve dans doc src/repository)
    //dans la variable $articleRepository et symfony appelle ma bdd ( c'est autowire)
    public function listArtiklos(ArticleRepository $articleRepository)
    {
        // en bdd je recouper tout les donne de la table article (findall)
        $artiklos = $articleRepository->findAll();
        // je envoie ma class vers html.twig avec ma variable $artiklos
        return $this->render('artiklos.html.twig', [
            'artiklos' => $artiklos
        ]);
    }

    /**
     * @Route("/artiklos/{id}", name="display_artikl")
     */
    public function displayArtikl(ArticleRepository $articleRepository, $id)
    {
        $artikl = $articleRepository->find($id);

        return $this->render('artikl.html.twig',[
            "artikl" => $artikl

        ]);
    }

    /**
     * @Route("/acceuil", name="page_acceuil")
     */
    public function dernierArtiklos(ArticleRepository $articleRepository)
    {

        $deux_artiklos = $articleRepository->findBy(
            ['is_published' => 1],
            ['createdAt' => 'DESC'],
            2);
        return $this->render('acceuil.html.twig',[
            "deux_artiklos" => $deux_artiklos
        ]);
    }
}