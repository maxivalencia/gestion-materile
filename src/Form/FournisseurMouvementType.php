<?php

namespace App\Form;

use App\Entity\Mouvement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FournisseurMouvementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            //->add('date')
            ->add('reference')
            ->add('debutSerie')
            ->add('finSerie')
            ->add('observation')
            ->add('expiration')
            //->add('date_reception')
            ->add('produit')
            //->add('type')
            //->add('etat')
            //->add('service')
            ->add('unite')
            ->add('fournisseur')
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
