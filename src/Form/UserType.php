<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $roles = [
            'Super-admin' => 'ROLE_SUPER_ADMIN',
            'admin' => 'ROLE_ADMIN',
            'administrateur-materiel' => 'ROLE_APPROVISIONNEMENT',
            'responsable-materiel' => 'ROLE_RESPONSABLE',
        ];
        $builder
            ->add('username')
            ->add('roles', ChoiceType::class, [
                'label' => 'Rôle',
                'choices' => $roles,
                //'multiple' => true,
                'expanded' => true,
                //'data' => true,
            ])
            ->add('password', RepeatedType::class,[
                'label' => 'Mot de passe',
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne sont pas identique',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' => ['label' => 'Veuillez entrer le mot de passe'],
                'second_options' => ['label' => 'Veuillez repeter le mot de passe'],
            ])
            ->add('nom')
            ->add('telephone')
            ->add('mail')
            ->add('service')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
