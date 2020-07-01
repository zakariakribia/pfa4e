<?php

namespace App\Form;

use App\Entity\Secretaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SecretaireType extends AbstractType
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
            ->add('dateNaissance')
            ->add('photoUrl')
            ->add('etablissement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Secretaire::class,
        ]);
    }
}
