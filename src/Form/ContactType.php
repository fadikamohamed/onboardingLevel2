<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Division;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre nom'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre prénom'
                ]
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Adresse e-mail',
                'attr' => [
                    'placeholder' => 'Veuillez entrer une adresse e-mail'
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Méssage',
                'attr' => [
                    'placeholder' => 'Veuillez écrire votre message ici'
                ]
            ])
            ->add('division', EntityType::class, [
                'label' => 'Département',
                'class' => Division::class,
                'choice_label' => 'name'
            ])
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'csrf_protection' => false,
        ]);
    }
}
