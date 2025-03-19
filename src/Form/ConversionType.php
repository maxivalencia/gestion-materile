<?php

namespace App\Form;

use App\Entity\Conversion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ConversionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite', null, [
                'label' => 'Quantité de Conversion',
            ])
            ->add('source', null, [
                'label' => 'Unité Source',
            ])
            ->add('destinataire', null, [
                'label' => 'Unité Destinataire',
            ])
            ->add('produit', null, [
                'label' => 'Article',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Conversion::class,
        ]);
    }
}
