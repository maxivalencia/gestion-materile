<?php

namespace App\Form;

use App\Entity\Mouvement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class AjoutMouvementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('produit', null, [
                'label' => 'Article',
            ])
            ->add('quantite', null, [
                'label' => 'Quantité',
            ])
            ->add('unite', null, [
                'label' => 'Unité',
            ])
            //->add('date')
            ->add('reference', null, [
                'label' => 'Référence',
            ])
            ->add('debutSerie', null, [
                'label' => 'Début du Numéro de Série',
            ])
            ->add('finSerie', null, [
                'label' => 'Fin du Numéro de Série',
            ])
            ->add('expiration', DateType::class, [
                'widget' => 'single_text', // Utilise un input de type date
                'html5' => true,           // Active le calendrier HTML5 natif
                'format' => 'yyyy-MM-dd',  // Format de la date (requis pour certains navigateurs)
                'required' => false,
                'label' => 'Date d\'expiration',
            ])
            //->add('date_reception')
            //->add('type')
            //->add('etat')
            //->add('service')
            //->add('fournisseur')
            //->add('expedition_id')
            //->add('user_reception')
            ->add('observation', null, [
                'label' => 'Observation',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mouvement::class,
        ]);
    }
}
