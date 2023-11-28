<?php

namespace App\Form;

use App\Entity\Jeu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class JeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre', TextType::class)
            ->add('dateSortie', DateType::class, ['widget' => 'single_text', 'attr' => ['class' => 'form-control']])
            ->add('note', NumberType::class)
            ->add('image', FileType::class, [
                'label' =>  'Ajoute une photo',
                'multiple' => false,
                'mapped' => false,
                'required' => false,
                'constraints' => [

                    new File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'La taille maximale autorisée est de {{ limit }}.',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPEG, PNG, GIF)',
                    ])

                ],
                'label_attr' => ['class' => 'file-label'],
            ])
            ->add('avis', TextareaType::class)
            //->add('dateTest')
            ->add('Ajouter', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jeu::class,
        ]);
    }
}
