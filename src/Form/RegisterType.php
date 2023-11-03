<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                // 'label' => 'Votre prénom',
                'label' => false,
                'constraints' => new Length(30, 2),
                'attr' => [
                    'placeholder' => 'Veuillez renseigner votre prénom',
                    'class' => 'form-input'
                ]
            ])
            ->add('lastName', TextType::class, [
                // 'label' => 'Votre nom',
                'label' => false,
                'constraints' => new Length(30, 2),
                'attr' => [
                    'placeholder' => 'Veuillez renseigner votre nom de famille',
                    'class' => 'form-input'
                ]
            ])
            ->add('email', EmailType::class, [
                // 'label' => 'Votre email',
                'label' => false,
                'constraints' => new Length(60, 2),
                'attr' => [
                    'placeholder' => 'Veuillez renseigner votre email',
                    'class' => 'form-input'
                ]
            ])
            // ->add('roles')
            // ->add('password')
            // ->add('enabled')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mots de passe doivent être identiques',
                // 'label' => 'Votre mot de passe',
                'label' => false,
                'required' => true,
                'first_options' => [
                    // 'label' => 'Mot de passe',
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre mot de passe',
                        'class' => 'form-input'
                    ]
                ],
                'second_options' => [
                    // 'label' => 'Confirmer votre mot de passe',
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Merci de confirmer votre mot de passe',
                        'class' => 'form-input'
                    ]
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire'
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
