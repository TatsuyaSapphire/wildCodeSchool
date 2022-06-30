<?php

namespace App\Form;

use App\Entity\ArgonautUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateArgonautFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'label' => 'Nom de L\'Argonaute',
            'attr' => [
                'placeholder' => 'Ecrivez un Nom',
                'class' => 'col-4'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'Merci de renseigner un Nom',
                ]),
                new Length([
                    'min' => 4,
                    'max' => 100,
                    'minMessage' => 'Le Nom doit contenir au moins {{ limit }} caractère',
                    'maxMessage' => 'Le Nom doit contenir au maximum {{ limit }} caractères',
                ]),
            ],
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Valider',
            'attr' => [
                'class' => 'btn btn-dark  col-4 offset-4 mt-5',
            ],
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArgonautUser::class,
        ]);
    }
}
