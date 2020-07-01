<?php

namespace App\Form;

use App\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etat')
            ->add('dateValidationSecretaire')
            ->add('dateValidationDP')
            ->add('dateValidationDE')
            ->add('diplome')
            ->add('secretaire')
            ->add('entreprise')
            ->add('laureat')
            ->add('etablissement')
            ->add('directeurPedagogique')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
