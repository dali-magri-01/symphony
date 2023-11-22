<?php

namespace App\Form;

use App\Entity\Tiers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TiersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tr_code', null, [
                'label' => 'Code',
                'required' => true,
            ])
            ->add('tr_lib', null, [
                'label' => 'Libelle',
                'required' => true,
            ])
            ->add('tr_adresse',null, [
                'label' => 'Adresse',
                'required' => false,
            ])
            ->add('tr_type_ident',null, [
                'label' => 'Type Ident',
                'required' => false,
            ])
            ->add('tr_ident',null, [
                'label' => 'Ident',
                'required' => false,
            ])
            ->add('tr_activite',null, [
                'label' => 'Activité',
                'required' => false,
            ])
            ->add('tr_email',null, [
                'label' => 'Email',
                'required' => false,
            ])
            ->add('tr_type_tiers', EntityType::class, [
                'class' => 'App\Entity\TypeTiers',
                'choice_label' => 'tt_lib',
                'label' => ' Type Tiers',
                'required' => true,
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => 'Choisissez Type Tiers',
            ])
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
            'data_class' => Tiers::class,
        ]);
    }
}
