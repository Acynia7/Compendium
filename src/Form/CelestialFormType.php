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
                'label' => 'Nom'
            ])
            ->add('mass', TextType::class, [
                'label' => 'Masse (kg)'
            ])
            ->add('radius', TextType::class, [
                'label' => 'Diamètre (km)'
            ])
            ->add('distance_from_earth', TextType::class, [
                'label' => 'Distance de la Terre (km)'
            ])
            ->add('temperature', TextType::class, [
                'label' => 'Température (K)'
            ])
            ->add('description', TextType::class, [
                'label' => 'Description'
            ])
            ->add('image_url', FileType::class, [
                'label' => 'Image',
                'required' => false,
                'mapped' => false,
                'constraints' => [
                    new Image(['maxSize' => '1024k'])
                ]
            ])
            ->add('type', EntityType::class, [
                'class' => CelestialBodyType::class,
                'choice_label' => 'name',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CelestialBodies::class,
        ]);
    }
}
