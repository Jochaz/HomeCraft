<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Civilite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomClient')
            ->add('PrenomClient')
            ->add('EmailClient')
            ->add('PasswordClient', PasswordType::class)
            ->add('PasswordConfirmClient', PasswordType::class)
            ->add('Civilite', EntityType::class, [
                'class' => Civilite::class,
                'choice_label' => 'LibelleCivilite',
            ])
            ->add('DateNaissance', BirthdayType::class, ['format' => 'dd-MM-yyyy',
                                                         'placeholder' => ['year' => 'Année', 
                                                                           'month' => 'Mois', 
                                                                           'day' => 'Jour',]
                                                        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
