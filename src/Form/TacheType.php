<?php

namespace App\Form;

use App\Entity\Tache;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('debut',DateTimeType::class,  [
                'date_widget' => 'single_text',  'required'   => true, 'label' => "Date de debut  de la tache à réaliser" ])
            ->add('fin',DateTimeType::class,  [
                'date_widget' => 'single_text',  'required'   => true, 'label' => "Date de fin de la tache à réaliser" ])
            ->add('description')
            ->add('ToutelaJournee')
            ->add('background_color',ColorType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}
