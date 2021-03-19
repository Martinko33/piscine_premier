<?php

// je cree mes chemin pour mes class : ArticleController, Route, AbstractController
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    // je cree annotation avec la class Route qui va cree mon URL et on utilisan
    // wildcard je recouper mon id et je le ajoute dans mon url
    /**
     * @Route("/articles/{id}", name="display_article")
     */
    public function displayArticle($id)
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
        // je fais return de ma funcion et je utilise render () ou je lui donne adresse ou il
        // doit s'envoyer , avec le tableau ou je recouper id de ma function dispayArticle($id)
        return $this-> render("article.html.twig", ["article" => $articles[$id]]);



    }
}