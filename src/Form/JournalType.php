<?php

namespace App\Form;

use App\Entity\Journal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JournalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jl_code',null, [
                'label' => 'Code',
                'required' => True,
            ])
            ->add('jl_lib',null, [
                'label' => 'Libelle',
                'required' => True,
            ])
            ->add('mois_exer', ChoiceType::class, [
                'label' => 'Type de numérotation',
                'required' => false,
                'choices' => [
                    'Numérotation par exercice' => 'E',
                    'Numérotation par mois' => 'M',
                ],
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => 'Choisissez un type de Numérotation ', // Optional placeholder text
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
            ->add('monnaie', EntityType::class, [
                'class' => 'App\Entity\Monnaie',
                'choice_label' => 'mon_lib',
                'label' => ' Monnaie',
                'required' => true,
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => 'Choisissez une Monnaie',
            ])
            ->add('compte', EntityType::class, [
                'class' => 'App\Entity\Compte',
                'choice_label' => 'concatenatedLabel',
                'label' => 'Compte',
                'required' => true,
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => 'Choisissez un Compte',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Journal::class,
        ]);
    }
}
