<?php

namespace App\Form;

use App\Entity\Ecritures;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EcrituresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

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
            ->add('libelle',null, [
                'label' => 'Libelle',
                'required' => false,
            ])
            ->add('sens', ChoiceType::class, [
                'label' => 'sens',
                'required' => false,
                'choices' => [
                    'Débit' => 'D',
                    'Crédit' => 'C',
                ],
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => 'Choisissez un Sens', // Optional placeholder text

            ])
            ->add('montant',null, [
                'label' => 'Montant',
                'required' => false,
            ])

            ->add('tier', EntityType::class, [
                'class' => 'App\Entity\Tiers',
                'choice_label' => 'getlibelletier',
                'label' => 'Tier',
                'required' => true,
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'placeholder' => 'Choisissez un Tier',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ecritures::class,
        ]);
    }
}
