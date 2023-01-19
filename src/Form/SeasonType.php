<?php

namespace App\Form;

use App\Entity\Season;
use App\Entity\Serie;
use App\Repository\SerieRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeasonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number')
            //->add('firstAirDate')
            ->add('firstAirDate', DateType::class, [
                'html5'=>true,
                'widget' => 'single_text',
            ])
            ->add('overview')
            ->add('poster')
            ->add('tmdbId')

            ->add('dateModified', DateType::class, [
                'html5'=>true,
                'widget' => 'single_text',
            ])
            ->add('serie', EntityType::class, [
                'class'=>Serie::class,
                'choice_label'=>'name',
                'placeholder'=>'saisir une serie',
                'query_builder'=>function(SerieRepository $serieRepository)
                {
                    return $serieRepository->createQueryBuilder('name')->orderBy('name.name','ASC');
                }

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Season::class,
        ]);
    }
}
