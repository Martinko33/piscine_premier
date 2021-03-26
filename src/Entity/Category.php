<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    // assert est pour controler (valider) le input dans formulaire si sont bien remplir etc
    /**
     * @ORM\Column(type="string" , length=255 )
     * @Assert\NotBlank(message="Tu as oublie remplir champ Title")
     * @Assert\Length(min = 3,
     *      max = 250,
     *      minMessage = "C'est quoi ton titre, fait l'effort et ajoute des lettre ou mots",
     *      maxMessage = "Halooo tu croix que les gens ont envie lire ton long title"
     * )
     * @Assert\Type(type={"alpha"},
     *       message="Pas des chiffre dans ce title stp")
     */
    private $title;

    /**
     * @ORM\Column [type="text", length=1000, nullable=true)
     * @Assert\NotBlank(message="Tu as oublie remplir champ Description")
     * @Assert\Type("string")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;


    //je fais oneToMany c'est monsieur Richellieu au sql, du coup je peux avoir plusier article ( se que j'appele je vois dans targetEntity du coup article)
    // dans une category, je suis dans entity category du coup One et j'appelle article Many
    // faut faire getter et setter
    /**
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="category")
     */
    private $articles;

    // quand j'ai oneToMany normalment dans Many j'ai plusier truc (ici articles) du coup plusier truc faut faire tableau
    // je construct tableau (un objet) avec la class arraycollection fait par doctrine
    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getArticles()
    {
        return $this->articles;
    }


    public function setArticles($articles)
    {
        $this->articles = $articles;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished): void
    {
        $this->isPublished = $isPublished;
    }







}