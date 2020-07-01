<?php

namespace App\Form;

use App\Entity\Etablissement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtablissementType extends AbstractType
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
            ->add('nomEtablissement')
            ->add('logo')
            ->add('pays')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etablissement::class,
        ]);
    }
}
