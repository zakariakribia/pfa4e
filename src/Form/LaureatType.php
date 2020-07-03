<?php

namespace App\Form;

use App\Entity\Laureat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LaureatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo')
            ->add('nom')
            ->add('prenom')
            ->add('password')
            ->add('adresse')
            ->add('email')
            ->add('telephone')
            ->add('deleted')
            ->add('datenaissance')
            ->add('photoUrl')
            ->add('cinNumSejour')
            ->add('lieuNaissance')
            ->add('nationalite')
            ->add('nomArabe')
            ->add('prenomArabe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Laureat::class,
        ]);
    }
}
