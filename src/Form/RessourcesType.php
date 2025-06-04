<?php

namespace App\Form;

use App\Entity\CelestialBodies;
use App\Entity\RelatedRessources;
use App\Entity\RelatedRessourcesType;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RessourcesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom de la ressource',
                'label_attr' => [
                    'class' => 'mb-2', // Ajoute une marge sous le label
                ],
                'attr' => [
                    'class' => 'form-control mb-3', // Ajoute une marge sous le champ
                ],
            ])
            ->add('url', TextType::class, [
                'label' => 'URL de la ressource',
                'label_attr' => [
                    'class' => 'mb-2', // Ajoute une marge sous le label
                ],
                'attr' => [
                    'class' => 'form-control mb-3', // Ajoute une marge sous le champ
                ],
            ])
            ->add('type', EntityType::class, [
                'class' => RelatedRessourcesType::class,
                'choice_label' => 'name', // Affiche le champ "name" de l'entité RelatedRessourcesType
                'label' => 'Type',
                'label_attr' => [
                    'class' => 'mb-2', // Ajoute une marge sous le label
                ],
                'attr' => [
                    'class' => 'form-select mb-3', // Utilisez "form-select" pour les listes déroulantes avec Bootstrap
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Soumettre',
                'attr' => [
                    'class' => 'form-control mb-3 btn btn-primary'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RelatedRessources::class,
            'csrf_protection' => false,
        ]);
    }
}
