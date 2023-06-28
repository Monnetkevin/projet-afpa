<?php


namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add( 'image', FileType::class,
                ['label' => 'Upload une image (jpeg ou jpg) :'])
            ->add('titre', TextType::class,
                [ "label" => "Votre Titre :"])
            ->add('auteur', TextType::class,
                ["label" => "Votre Nom d'utilisateur :"])

            ->add('description', TextareaType::class,
                ["label" => "Description de l'article :"]);

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}