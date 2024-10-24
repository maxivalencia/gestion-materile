<?php

namespace App\Form;

use App\Entity\HistoriqueMateriel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistoriqueMaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet')
            ->add('sujet')
            ->add('date')
            ->add('ancien')
            ->add('nouveau')
            ->add('user')
            ->add('materiel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HistoriqueMateriel::class,
        ]);
    }
}
