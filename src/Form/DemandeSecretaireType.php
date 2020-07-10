<?php

namespace App\Form;

use App\Controller\DemandeController;
use App\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeSecretaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Verified' => DemandeController::ETAT_ONE,
                    'In Process' => DemandeController::ETAT_TWO
                ],
                'required' => true,
                'expanded' => false,
                'multiple' => false,
                'label' => 'Etat de Demande' 
            ])
            ->add('diplome', null, [
                'required'   => true
            ])
            ->add('laureat', null, [
                'required'   => true
            ])
            ->add('etablissement', null, [
                'required'   => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
