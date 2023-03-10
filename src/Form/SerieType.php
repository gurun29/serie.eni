<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label' => 'Title',
            ])
            ->add('overview', null,[
                'required' => false,
            ])
            ->add('genre')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Cancelled' => 'canceled',
                    'ended' => 'ended',
                    'returning' => 'returning'
                ],
                'multiple'=>false
            ])
            ->add('vote')
            ->add('popularity')
            ->add('firstAirDate', DateType::class, [
                'html5'=>true,
                'widget' => 'single_text',
            ])
            ->add('lastAirDate', DateType::class, [
                'html5'=>true,
                'widget' => 'single_text',
            ])
            ->add('backdrop')
            //->add('poster')
            ->add('poster', FileType::class,[
                'label' => 'poster',
                'multiple' => false,
                'mapped' => false,
                'required' => false
            ])
            ->add('tmbdId')



        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
