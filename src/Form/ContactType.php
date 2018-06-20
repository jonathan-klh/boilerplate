<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('sujet', ChoiceType::class, [
                'choices' => [
                    'Choisir' => 'empty',
                    'Demande de contact' => 'Demande de contact',
                    'Signaler un problème' =>  'Signaler un problème',
                    'Demande d\'inscription' => 'Demande d\'inscription'
                ]
            ])
        ;

        $builder
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData')
            )
        ;
    }


    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();

        switch ($event->getData()->getSujet()){
            case 'Demande de contact':
                $form
                    ->add('email', EmailType::class,[
                        'required' => true
                    ])
                    ->add('nom', TextType::class, [
                        'required' => true
                    ])
                    ->add('message', TextareaType::class, [
                        'required' => true
                    ])
                    ->add('submit', SubmitType::class)

                ;
                break;
            case 'Signaler un problème':
                $form
                    ->add('raison', ChoiceType::class, [
                        'choices' => [
                            'Une erreur est survenue' => 'error',
                            "J'ai besoin d'aide" => "help",
                            'Autre' => 'other'
                        ],
                        'required' => true
                    ])
                    ->add('details', TextareaType::class, [
                        'required' => true
                    ])
                    ->add('submit', SubmitType::class)

                ;
                break;
            case 'Demande d\'inscription':
                $form
                    ->add('email', EmailType::class, [
                        'required' => true
                    ])
                    ->add('nom', TextType::class, [
                        'required' => true
                    ])
                    ->add('telephone', TextType::class, [
                        'required' => false
                    ])

                    ->add('adresse', TextType::class,[
                        'required' => true
                    ])
                    ->add('message', TextareaType::class,[
                        'required' => false
                    ])

                    ->add('submit', SubmitType::class)

                ;
                break;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'sujet' => null,
            'formAjax' => null
        ]);
    }
}
