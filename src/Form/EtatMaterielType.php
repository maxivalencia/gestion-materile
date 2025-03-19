<?php

namespace App\Form;

use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EtatMaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text', // Utilise un input de type date
                'html5' => true,           // Active le calendrier HTML5 natif
                'format' => 'yyyy-MM-dd',  // Format de la date (requis pour certains navigateurs)
                'label' => 'Date',
            ])
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
            ->add('service', null, [
                'label' => 'Service',
            ])
            ->add('etat', null, [
                'label' => 'Etat',
            ])
            ->add('user', null, [
                'label' => 'Utilisateur',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
