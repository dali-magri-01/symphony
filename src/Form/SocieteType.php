<?php

namespace App\Form;

use App\Entity\Societe;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Doctrine\ORM\EntityRepository;





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
                'constraints' => [
                    new Assert\Regex([
                        'pattern' => '/^\d{7}[A-Z]$/',
                        'message' => 'MF non validé.'
                    ]),
                    ]
            ])
            ->add('rue',null, [
                'label' => 'Rue',
                'required' => false,
            ])
            ->add('ville',null, [
                'label' => 'Ville',
                'required' => false,
            ])
            ->add('pays', EntityType::class, [
                'class' => 'App\Entity\Pays',
                'choice_label' => 'nom_fr_fr',
                'label' => ' Pays',
                'required' => true,
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.nom_fr_fr', 'ASC');
                },
                'placeholder' => 'Choisissez un pays',
            ])
            ->add('devise', EntityType::class, [
                'class' => 'App\Entity\Devise',
                'choice_label' => 'code',
                'label' => ' Devise',
                'required' => true,
                'attr' => [
                    'class' => 'form-control select2',
                ],
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.code', 'ASC');
                },
                'placeholder' => 'Choisissez une Devise',
            ])

            ->add('rc',null, [
                'label' => 'RC',
                'required' => false,
            ])
            ->add('codePostal',null, [
                'label' => 'Code Postal',
                'required' => false,
            ])
            ->add('actif', CheckboxType::class, [
                'label' => 'Actif',
                'required' => false,
            ])
            ->add('logoFilename', FileType::class, [
                'label' => 'Logo',
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
                'data_class' => null,
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
