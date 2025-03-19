<?php

namespace App\Form;

use App\Entity\HistoriqueMateriel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class HistoriqueMaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet', null, [
                'label' => 'Objet',
            ])
            ->add('sujet', null, [
                'label' => 'Sujet',
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text', // Utilise un input de type date
                'html5' => true,           // Active le calendrier HTML5 natif
                'format' => 'yyyy-MM-dd',  // Format de la date (requis pour certains navigateurs)
                'label' => 'Date',
            ])
            ->add('ancien', null, [
                'label' => 'Ancienne donnée',
            ])
            ->add('nouveau', null, [
                'label' => 'Nouvelle donnée',
            ])
            ->add('user', null, [
                'label' => 'Utilisateur',
            ])
            ->add('materiel', null, [
                'label' => 'Matériel concerné',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HistoriqueMateriel::class,
        ]);
    }
}
