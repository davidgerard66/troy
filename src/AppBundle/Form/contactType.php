<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class contactType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('objet',ChoiceType::class, array(
                'choices' => array('Renseignements' => 'Renseignements',
                                    'Devis' => 'Devis',
                                    'Réservation' => 'Réservation'),
                'required'=>false,
                'label'=>'Objet de votre message',
                'mapped'=>false))

            ->add('email',EmailType::class, array('label'=>'Votre e-mail', 'mapped'=>false))
            ->add('nom',null,array('required'=>false,'label'=>'Votre nom','mapped'=>false))
            ->add('telephone',null,array('required'=>false,'label'=>'Votre n° de Téléphone','mapped'=>false))
            ->add('contenu',TextareaType::class,array('label'=>'Votre message / Vos questions','mapped'=>false))
            ->add('envoyer',SubmitType::class,array('label'=>'Envoyer','attr'=> array('class'=>'btn btn-success')));
    }

    public function getName()
    {
        return 'appbundle_contact';
    }
}