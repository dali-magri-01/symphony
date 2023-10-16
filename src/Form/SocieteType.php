<?php

namespace App\Form;

use App\Entity\Societe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class SocieteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('matriculeFiscale',TextType::class, [
                'label' => 'Matricule Fiscale',
            ])
            ->add('rue',TextType::class, [
                'label' => 'Rue',
            ])
            ->add('ville',TextType::class, [
                'label' => 'Ville',
            ])
            ->add('pays',TextType::class, [
                'label' => 'Pays',
            ])
            ->add('rc',TextType::class, [
                'label' => 'RC',
            ])
            ->add('actif',ChoiceType::class, [
                'choices'  => [
                    'Veuillez sélectionner votre choix' => null,
                    'Oui' => true,
                    'Non' => false,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Societe::class,
        ]);
    }
}
