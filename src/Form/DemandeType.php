<?php

namespace App\Form;

use App\Controller\DemandeController;
use App\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('etat', ChoiceType::class, [
                'choices' => [
                    'Verified' => DemandeController::ETAT_ONE,
                    'Not Valid' => DemandeController::ETAT_TWO
                ],
                'required' => true,
                'expanded' => false,
                'multiple' => false,
                'label' => 'Etat de Demande' 
            ])
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

        // $builder->get('etat')
        // ->addModelTransformer(new CallbackTransformer(
        //     function ($rolesArray) {
        //         // transform the array to a string
        //         return count($rolesArray)? $rolesArray[0]: null;
        //     },
        //     function ($rolesString) {
        //         // transform the string back to an array
        //         return [$rolesString];
        //     }
        // ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
