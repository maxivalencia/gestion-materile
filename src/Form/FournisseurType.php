<?php

namespace App\Form;

use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class FournisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'label' => 'Nom du Fournisseur',
            ])
            ->add('sigle', null, [
                'label' => 'Sigle du Fournisseur',
            ])
            ->add('nif', null, [
                'label' => 'Numéro d\'Identification Fiscale du Fournisseur',
            ])
            ->add('stat', null, [
                'label' => 'Numéro Statistique du Fournisseur',
            ])
            ->add('rcs', null, [
                'label' => 'Numéro de Régistre du Commerce et de Société du Fournisseur',
            ])
            ->add('mail', null, [
                'label' => 'Mail du Fournisseur',
            ])
            ->add('telephone', null, [
                'label' => 'Téléphone du Fournisseur',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fournisseur::class,
        ]);
    }
}
