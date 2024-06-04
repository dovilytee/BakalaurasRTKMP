<?php
// src/Form/PlaceType.php

namespace App\Form;

use App\Entity\Place;
use App\Entity\PlaceCity;
use App\Entity\PlaceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PlaceTypee extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('address', TextType::class)

            ->add('description', TextType::class)
            ->add('working', TextType::class)
            ->add('price', TextType::class)

            ->add('type', TextType::class)

            ->add('city', TextType::class)

            ->add('isVisible', CheckboxType::class)

            ->add('placeType', EntityType::class, [
                'class' => PlaceType::class,
                'choice_label' => 'name',
            ])

            ->add('placeCity', EntityType::class, [
                'class' => PlaceCity::class,
                'choice_label' => 'name',
            ])

            ->add('photo', FileType::class, [
                'label' => 'Photo (JPEG or PNG file)',
                'mapped' => false, // This field is not mapped to a property of the entity
                'required' => false, // Set to true if the field is required
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
