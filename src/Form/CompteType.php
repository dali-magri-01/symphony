<?php

namespace App\Form;

use App\Entity\Compte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class CompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cp_code')
            ->add('cp_lib')
            ->add('cp_type_tiers', EntityType::class, [
                'class' => 'App\Entity\TypeTiers',
                'choice_label' => 'tt_lib',
                'label' => 'Type Tiers',
                'required' => true,
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => 'Choisissez un Compte',
            ])
            ->add('cp_sens', ChoiceType::class, [
                'label' => 'Sens',
                'required' => false,
                'choices' => [
                    'Débit' => 'D',
                    'Crédit' => 'C',
                    'Both' => 'B',
                ],
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => '', // Optional placeholder text

            ])
            ->add('cp_actif', ChoiceType::class, [
                'label' => 'Actif',
                'required' => false,
                'choices' => [
                    'Oui' => 'O',
                    'Non' => 'N',
                ],
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => '', // Optional placeholder text
            ])
            ->add('cp_traduction')
            ->add('cp_analytique', ChoiceType::class, [
                'label' => 'Analytique',
                'required' => false,
                'choices' => [
                    'Oui' => 'O',
                    'Non' => 'N',
                ],
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => '', // Optional placeholder text
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
            'data_class' => Compte::class,
        ]);
    }
}
