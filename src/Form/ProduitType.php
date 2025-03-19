<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'label' => 'Nom de l\'Article',
            ])
            ->add('sigle', null, [
                'label' => 'Nom de l\'Article',
            ])
            ->add('code', null, [
                'label' => 'Code de l\'Article',
            ])
            ->add('caracteristique', null, [
                'label' => 'Caractéristique de l\'Article',
            ])
            ->add('type', null, [
                'label' => 'Type de l\'Article',
            ])
            ->add('genre', null, [
                'label' => 'Genre de l\'Article',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
