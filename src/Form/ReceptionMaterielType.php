<?php

namespace App\Form;

use App\Entity\Materiel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ReceptionMaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('date', DateType::class, [
            //    'widget' => 'single_text', // Utilise un input de type date
            //    'html5' => true,           // Active le calendrier HTML5 natif
            //    'format' => 'yyyy-MM-dd',  // Format de la date (requis pour certains navigateurs)
            //])
            //->add('reference')
            //->add('serie')
            //->add('observation')
            //->add('produit')
            //->add('service')
            ->add('etat', null, [
                'label' => 'Etat',
            ])
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
