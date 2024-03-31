<?php

namespace App\Form;

use App\Entity\Ecritures;
use App\Entity\PieceComptable;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class PieceComptableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('datepiece', DateType::class, [
                'label' => 'Date',
                'required' => true,
                // Autres options éventuelles
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control datetimepicker-input', // Classe CSS
                    'data-target' => '#datetimepicker-minimum'
                ],
            ])
            ->add('libelle',null, [
                'label' => 'Libelle',
                'required' => True,
            ])
            ->add('id', HiddenType::class, [
                'label' => 'Libelle',
                'disabled' => true,
            ])

            ->add('numero_pc',null, [
                'label' => 'Numéro PC',
                'required' => False,
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'numero_pc', // Ajout de l'ID ici
                ],
            ])
            ->add('monnaie', EntityType::class, [
                'class' => 'App\Entity\Monnaie',
                'choice_label' => 'mon_lib',
                'label' => ' Monnaie',
                'required' => true,
                'attr' => [
                    'class' => 'form-control select2',
                    'id' => 'monnaie', // Ajout de l'ID ici
                ],
                'placeholder' => 'Choisissez une Monnaie',
            ])

            ->add('tauxchange',null, [
                'label' => 'Taux',
                'required' => false,
            ])
            ->add('journal',EntityType::class, [
                'class' => 'App\Entity\Journal',
                'choice_label' => 'getJournal',
                'label' => ' Journal',
                'required' => false,
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => 'Choisissez Journal',
            ])
            ->add('Ecritures', CollectionType::class, [
                'entry_type' => EcrituresType::class,
                'label' => 'Ecritures',
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PieceComptable::class,
        ]);
    }
}
