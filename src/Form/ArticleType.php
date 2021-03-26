<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    // je cree form par la terminal, buildform c'est la methode pour faire formulaire
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        // title, contant etc c'est des proprietes
        $builder
            ->add('title')
            ->add('content')
            ->add('createdAt')
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => false,
                'mapped' => false
            ])
            ->add('is_published')
            // je peux ajouter autre table ( category) check doc EntityType, utiliser de cote manyToOne car faut sortir que une valeur pas tableau
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title'
        ])
            ->add('submit',SubmitType::class)
        ;
    }
    // relier chemin entree class et doctrine pour form
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
