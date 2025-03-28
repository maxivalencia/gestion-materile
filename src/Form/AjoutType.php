<?php

namespace App\Form;

use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AjoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('date')
            ->add('reference', null, [
                'label' => 'Référence',
            ])
            ->add('serie', null, [
                'label' => 'Numéro de Série',
            ])
            ->add('observation', null, [
                'label' => 'Observation',
            ])
            ->add('produit', null, [
                'label' => 'Article',
            ])
            //->add('service')
            //->add('etat')
            //->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
