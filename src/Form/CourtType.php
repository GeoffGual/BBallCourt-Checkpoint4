<?php

namespace App\Form;

use App\Entity\Court;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class CourtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'label'=> 'Nom du terrain',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Court Name'
                    ]
                ])
            ->add('town',TextType::class,[
                'label'=> 'Ville',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Court City'
                    ]
                ])
            ->add('address',TextType::class,[
                'label'=> 'Adresse du terrain',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Court Adress'
                    ]
                ])
            ->add('pictureFile', VichFileType::class, [
                'label' => 'Photo du terrain',
                'required'      => false,
                'allow_delete'  => true, // not mandatory, default is true
                'download_uri' => true, // not mandatory, default is true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Court::class,
        ]);
    }
}
