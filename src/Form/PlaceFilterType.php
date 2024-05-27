<?php

namespace App\Form;

use App\Entity\PlaceCity;
use App\Entity\User;
use App\Entity\Place;
use App\Entity\PlaceType;
use App\Repository\PlaceRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PlaceFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('placeType', EntityType::class, ['class' => PlaceType::class,
                                                        'choice_label' => 'name',
                                                        'placeholder' => 'Choose a place type',
                                                        'required' => false,
            ])
            ->add('placeCity', EntityType::class, ['class' => PlaceCity::class,
                'choice_label' => 'name',
                'placeholder' => 'Choose a city',
                'required' => false,
        ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
