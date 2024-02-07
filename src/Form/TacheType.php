<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Tache;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\StringType;
use phpDocumentor\Reflection\PseudoTypes\False_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,array('attr'=>['class'=>'form-control','placeholder'=>'Nom de la tâche']))
            ->add('debut',DateTimeType::class,  [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                    'max' => date('Y-m-d') ]])
            ->add('fin',DateTimeType::class,  [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control',
                    'max' => date('Y-m-d') ]])
            ->add('description',TextType::class,array('attr'=>['class'=>'form-control']))
            ->add('background_color',ColorType::class,['attr'=>['class'=>'form-control'],'label'=>'Couleur de la tâche'])
            ->add('Category',EntityType::class,['class'=>Categorie::class,'label'=>'nom de la catégorie','attr'=>['class'=>'form-control']]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}
