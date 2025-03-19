<?php

namespace App\Form;

use App\Entity\Mouvement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CommandeMouvementType extends AbstractType
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
            //->add('debutSerie')
            //->add('finSerie')
            ->add('observation', null, [
                'label' => 'Observation',
            ])
            //->add('expiration')
            //->add('date_reception')
            //->add('type')
            //->add('etat')
            //->add('service')
            //->add('fournisseur')
            //->add('expedition_id')
            //->add('user_reception')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Mouvement::class,
        ]);
    }
}
