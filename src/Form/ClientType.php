<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Civilite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Civilite', EntityType::class, [
                'class' => Civilite::class,
                'choice_label' => 'LibelleCivilite'
            ])
            ->add('NomClient')
            ->add('PrenomClient')
            ->add('DateNaissance')
            ->add('EmailClient')
            ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
