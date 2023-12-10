<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pr_code',null, [
                'label' => 'Code',
                'required' => True,
            ])
            ->add('pr_lib',null, [
                'label' => 'Libelle',
                'required' => True,
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
            'data_class' => Projet::class,
        ]);
    }
}
