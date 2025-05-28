<?php

namespace App\Form;

use App\Entity\CelestialBodies;
use App\Entity\CelestialBodyType;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class CelestialFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'mb-2', // Ajoute une marge sous le label
                ],
                'attr' => [
                    'class' => 'form-control mb-3', // Ajoute une marge sous le champ
                ],
            ])
            ->add('mass', TextType::class, [
                'label' => 'Masse (kg)',
                'label_attr' => [
                    'class' => 'mb-2', // Ajoute une marge sous le label
                ],
                'attr' => [
                    'class' => 'form-control mb-3', // Ajoute une marge sous le champ
                ],
            ])
            ->add('radius', TextType::class, [
                'label' => 'Diamètre (km)',
                'label_attr' => [
                    'class' => 'mb-2', // Ajoute une marge sous le label
                ],
                'attr' => [
                    'class' => 'form-control mb-3', // Ajoute une marge sous le champ
                ],
            ])
            ->add('distance_from_earth', TextType::class, [
                'label' => 'Distance de la Terre (km)',
                'label_attr' => [
                    'class' => 'mb-2', // Ajoute une marge sous le label
                ],
                'attr' => [
                    'class' => 'form-control mb-3', // Ajoute une marge sous le champ
                ],
            ])
            ->add('temperature', TextType::class, [
                'label' => 'Température (K)',
                'label_attr' => [
                    'class' => 'mb-2', // Ajoute une marge sous le label
                ],
                'attr' => [
                    'class' => 'form-control mb-3', // Ajoute une marge sous le champ
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'mb-2', // Ajoute une marge sous le label
                ],
                'attr' => [
                    'class' => 'form-control mb-3', // Ajoute une marge sous le champ
                ],
            ])
            ->add('image_url', FileType::class, [
                'label' => 'Image',
                'label_attr' => [
                    'class' => 'mb-2', // Ajoute une marge sous le label
                ],
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new Image(['maxSize' => '1024k'])
                ],
                'attr' => [
                    'class' => 'form-control mb-3', // Ajoute une marge sous le champ
                ],
            ])
            ->add('type', EntityType::class, [
                'class' => CelestialBodyType::class,
                'choice_label' => 'name', // Affiche le champ "name" de l'entité CelestialBodyType
                'label' => 'Type',
                'label_attr' => [
                    'class' => 'mb-2', // Ajoute une marge sous le label
                ],
                'attr' => [
                    'class' => 'form-select mb-3', // Utilisez "form-select" pour les listes déroulantes avec Bootstrap
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' => [
                    'class' => 'form-control mb-3 btn btn-primary'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CelestialBodies::class,
            'csrf_protection' => false, // Désactive la protection CSRF
        ]);
    }
}
