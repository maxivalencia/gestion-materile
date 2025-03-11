<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $roles = [
            'Utilisateur simple' => 'ROLE_USER_AUTORISED',
            'Gestionnaire des stocks' => 'ROLE_RESPONSABLE_STOCK',
            'Gestionnaire des materiels' => 'ROLE_RESPONSABLE_MATERIEL',
            'Responsable premier niveau' => 'ROLE_RESPONSABLE',
            'Service Informatique et Télécommunication' => 'ROLE_GESTIONNAIRE_INFORMATIQUE',
            'Service Automobile' => 'ROLE_GESTIONNAIRE_AUTOMOBILE',
            'Service Soutien' => 'ROLE_GESTIONNAIRE_SOUTIEN',
            'Service Sanitaire' => 'ROLE_GESTIONNAIRE_SANTE',
            'Mag/Appro' => 'ROLE_GESTIONNAIRE_APPROVISIONNEMENT',
            'Responsable principale' => 'ROLE_GESTIONNAIRE',
            'Administrateur' => 'ROLE_ADMIN',
            'Administrateur principale' => 'ROLE_SUPER_ADMIN',
        ];
        $builder
            ->add('username')
            /* ->add('roles', ChoiceType::class, [
                'label' => 'Rôle',
                'choices' => $roles,
                //'multiple' => true,
                'expanded' => false,
                'data' => true,
            ]) */
                ->add('rolesimple', ChoiceType::class, [
                'label' => 'Rôle',
                'choices' => $roles,
                //'multiple' => true,
                'expanded' => false,
                'data' => true,
                'mapped' => false,
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
