<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class JoueurType extends AbstractType {

    /**
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::class,[])
                ->add('numero',NumberType::class, ["label" => "Numéro"])
                ->add('nomClub',TextType::class, ["label" => "Nom du club"])
                ->add('dateAdhesion',DateType::class, ["label" => "Date d'Adhésion"])
                ->add("submit", SubmitType::class, ["label" => "Créer", ]);
    }

    /**
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {

        // 
        
    }
    
}

?>