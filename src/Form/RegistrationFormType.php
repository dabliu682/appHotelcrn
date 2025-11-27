<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                'label' => 'Nombre completo',
                'constraints' => [
                    new NotBlank(['message' => 'Por favor ingresa tu nombre']),
                ],
            ])
            ->add('username', null, [
                'label' => 'Usuario',
                'constraints' => [
                    new NotBlank(['message' => 'Por favor ingresa un usuario']),
                ],
            ])
            ->add('celular', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'label' => 'Celular',
                'constraints' => [
                    new NotBlank(['message' => 'Por favor ingresa un numero de celular']),
                ],
            ])
            ->add('roles', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, [
                'label' => 'Rol',
                'choices' => [
                    'Administrador' => 'ROLE_ADMINISTRADOR',
                    'Caja' => 'ROLE_CAJA',
                ],
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                'attr' => ['class' => 'form-select'],
                'mapped' => false, // No se mapea directamente al objeto User
            ])
            ->add('tipo', \Symfony\Component\Form\Extension\Core\Type\ChoiceType::class, [
                'label' => 'Tipo',
                'choices' => [
                    'Empleado' => '1',
                    'Administrador' => '2',
                    'Asociado' => '3',
                ],
                'multiple' => false,
                'expanded' => false,
                'required' => true,
                'attr' => ['class' => 'form-select'],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Contraseña',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
