<?php

namespace App\Form;

use App\Entity\Mouvement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class MouvementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite', null, [
                'label' => 'Quantité',
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text', // Utilise un input de type date
                'html5' => true,           // Active le calendrier HTML5 natif
                'format' => 'yyyy-MM-dd',  // Format de la date (requis pour certains navigateurs)
                'label' => 'Date'
            ])
            ->add('reference', null, [
                'required' => false,
                'label' => 'Référence',
            ])
            ->add('debutSerie', null, [
                'required' => false,
                'label' => 'Début Numéro de Série',
            ])
            ->add('finSerie', null, [
                'required' => false,
                'label' => 'Fin Numéro de Série',
            ])
            ->add('observation', null, [
                'required' => false,
                'label' => 'Observation',
            ])
            ->add('expiration', DateType::class, [
                'widget' => 'single_text', // Utilise un input de type date
                'html5' => true,           // Active le calendrier HTML5 natif
                'format' => 'yyyy-MM-dd',  // Format de la date (requis pour certains navigateurs)
                'required' => false,
                'label' => 'Date d\'expiration',
            ])
            ->add('date_reception', DateType::class, [
                'widget' => 'single_text', // Utilise un input de type date
                'html5' => true,           // Active le calendrier HTML5 natif
                'format' => 'yyyy-MM-dd',  // Format de la date (requis pour certains navigateurs)
                'required' => false,
                'label' => 'Date de réception',
            ])
            ->add('produit', null, [
                'label' => 'Article',
            ])
            ->add('type', null, [
                'label' => 'Type',
            ])
            ->add('etat', null, [
                'label' => 'Etat',
            ])
            ->add('service', null, [
                'label' => 'Service',
            ])
            ->add('unite', null, [
                'label' => 'Unité',
            ])
            ->add('fournisseur', null, [
                'label' => 'Fournisseur',
            ])
            ->add('expedition_id', null, [
                'label' => 'Expedetion identification',
            ])
            ->add('user_reception', null, [
                'label' => 'Utilisateur réceptionnaire',
            ])
            ->add('user_expedition', null, [
                'label' => 'Utilisateur expéditaire',
            ])
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mouvement::class,
        ]);
    }
}
