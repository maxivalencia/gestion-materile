<?php

namespace App\Form;

use App\Entity\Mouvement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsommationArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite', null, [
                'label' => 'Quantité',
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
            ->add('observation', null, [
                'label' => 'Observation',
            ])
            //->add('expiration')
            //->add('date_reception')
            ->add('produit', null, [
                'label' => 'Produit',
            ])
            //->add('type')
            //->add('etat')
            //->add('service')
            ->add('unite', null, [
                'label' => 'Unité',
            ])
            //->add('fournisseur')
            //->add('expedition_id')
            //->add('user_reception')
            //->add('user_expedition')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mouvement::class,
        ]);
    }
}
