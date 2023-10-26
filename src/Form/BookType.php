<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{//buildform =fonction predefinie
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder//balise form fyha aucune input
            ->add('ref')
            ->add('title')
            ->add('category',ChoiceType::class,[
'choices'=>[
'Science'=>'science',
'Math'=>'math',
'History'=>'history',
],
'expanded'=>true,
'multiple'=>false
            ])
            ->add('publicationDate')
            ->add('published')
            ->add('author',EntityType::class,[
                'class'=>Author::class,
                'choice_label'=>'username'
            ])
            ->add('Actions',UrlType::class,[
        'required' => false,
        'label' => 'Lien vers l\'action',
        'block_prefix' => 'actions',
        'edit' => 'Lien vers l\'action',
        'delete' => 'Lien vers l\'action',
            ])
            ->add('Add',SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }

}