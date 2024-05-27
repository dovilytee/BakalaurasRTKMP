<?php


namespace App\Form;

use App\Entity\TripRating;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripRatingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rating', ChoiceType::class, [
                'choices'  => [
                    '⭐' => 1,
                    '⭐⭐' => 2,
                    '⭐⭐⭐' => 3,
                    '⭐⭐⭐⭐' => 4,
                    '⭐⭐⭐⭐⭐' => 5,
                ],
                'expanded' => true, // to display as radio buttons
                'multiple' => false,
            ])
            ->add('comment', TextareaType::class, [
                'required'  => false,
                'attr' => ['placeholder' => 'Leave a comment...']
            ])
            ->add('save', SubmitType::class, ['label' => 'Submit Rating']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TripRating::class,
        ]);
    }
}