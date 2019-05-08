<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Pays;
use App\Entity\TypeAdresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomAdresse')
            ->add('Rue1Adresse')
            ->add('Rue2Adresse')
            ->add('Rue3Adresse')
            ->add('CodePostalAdresse')
            ->add('VilleAdresse')
            ->add('PaysAdresse', EntityType::class,[
                'class' => Pays::class,
                'choice_label' => 'LibellePays'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
