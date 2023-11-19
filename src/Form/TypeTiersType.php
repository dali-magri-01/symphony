<?php

namespace App\Form;

use App\Entity\TypeTiers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TypeTiersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tt_code')
            ->add('tt_lib')
            ->add('societe', EntityType::class, [
                'class' => 'App\Entity\Societe',
                'choice_label' => 'libelle',
                'label' => ' Sociéte',
                'required' => true,
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => 'Choisissez une Sociéte',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeTiers::class,
        ]);
    }
}
