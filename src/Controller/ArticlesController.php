<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;



class ArticlesController extends AbstractController
{
    // je cree annotation avec la class Route qui va cree mon URL
    /**
     * @Route("/articles", name="list_articles")
     */
    public function listArticles()
    {
        $articles = [
            1 => [
                'id' => 1,
                'title' => 'Une machine à laver',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci corporis dolor eum ex exercitationem harum hic inventore iste laboriosam, laborum libero neque nostrum nulla officia porro quod velit voluptatem.',
                'image' => 'https://image.darty.com/gros_electromenager/lavage_sechage/lave-linge_hublot/whirlpool_awod4714_t1406074020006A_142108315.jpg'
            ],
            2 => [
                'id' => 2,
                'title' => 'Radar',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci corporis dolor eum ex exercitationem harum hic inventore iste laboriosam, laborum libero neque nostrum nulla officia porro quod velit voluptatem.',
                'image' => 'https://image.darty.com/gros_electromenager/lavage_sechage/lave-linge_hublot/whirlpool_awod4714_t1406074020006A_142108315.jpg'
            ],
            3 => [
                'id' => 3,
                'title' => 'Gobelet',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci corporis dolor eum ex exercitationem harum hic inventore iste laboriosam, laborum libero neque nostrum nulla officia porro quod velit voluptatem.',
                'image' => 'https://image.darty.com/gros_electromenager/lavage_sechage/lave-linge_hublot/whirlpool_awod4714_t1406074020006A_142108315.jpg'
            ],
            4 => [
                'id' => 4,
                'title' => 'Iphone',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci corporis dolor eum ex exercitationem harum hic inventore iste laboriosam, laborum libero neque nostrum nulla officia porro quod velit voluptatem.',
                'image' => 'https://image.darty.com/gros_electromenager/lavage_sechage/lave-linge_hublot/whirlpool_awod4714_t1406074020006A_142108315.jpg'
            ],
            5 => [
                'id' => 5,
                'title' => 'Une machine à laver 2',
                'description' => 'Avec cette machine, vous pourrez nettoyer les pires tâches, même Balkany',
                'image' => 'https://image.darty.com/gros_electromenager/lavage_sechage/lave-linge_hublot/whirlpool_awod4714_t1406074020006A_142108315.jpg'
            ],
            6 => [
                'id' => 6,
                'title' => 'Radar 2',
                'description' => 'Retrouvez vos objets perdus, même la fierté de Denis',
                'image' => 'https://image.darty.com/gros_electromenager/lavage_sechage/lave-linge_hublot/whirlpool_awod4714_t1406074020006A_142108315.jpg'
            ],
            7 => [
                'id' => 7,
                'title' => 'Gobelet 2',
                'description' => 'blablabla',
                'image' => 'https://image.darty.com/gros_electromenager/lavage_sechage/lave-linge_hublot/whirlpool_awod4714_t1406074020006A_142108315.jpg'
            ],
            8 => [
                'id' => 8,
                'title' => 'Iphone 3',
                'description' => 'blablabla',
                'image' => 'https://image.darty.com/gros_electromenager/lavage_sechage/lave-linge_hublot/whirlpool_awod4714_t1406074020006A_142108315.jpg'
            ]

        ];
        // je fais return de ma funcion et je utilise methode render () quelle me envoye a mon twig -> ou il a envoie(je donne adresse) il
        // doit envoyer quoi, (le tableau articles)
        return $this-> render("articles.html.twig", ["articles" => $articles]);


    }
}