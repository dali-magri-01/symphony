<?php

namespace App\Form;

use App\Entity\Menu;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null, [
                'label' => 'Nom',
                'required' => True,
            ])
            ->add('parentId', EntityType::class, [
                'class' => Menu::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('m')
                        ->where('m.parentId IS NULL')
                        ->orderBy('m.name', 'ASC');
                },
                'choice_label' => 'name',
                'required' => false,
                'placeholder' => 'Sélectionnez ......', // Texte de la ligne vide

            ])
            ->add('ordre',null, [
                'label' => 'ordre',
                'required' => True,
            ])
            ->add('link',null, [
                'label' => 'Link',
                'required' => True,
            ])
            ->add('icon',null, [
                'label' => 'Icon',
                'required' => True,
            ])
            ->add('active', CheckboxType::class, [
                'label' => 'Active',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
