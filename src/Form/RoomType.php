<?php

namespace App\Form;

use App\Entity\Establishment;
use App\Entity\Room;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('capacity')
            ->add('establishment', EntityType::class, [
                'class' => Establishment::class,
                'choice_label' => 'id',
            ])
            ->add('images', fileType::class, [
                'mapped' => false,
                'multiple' => true,
                'required' => false,
                'attr' => ['class' => 'form-control', 'accept' => '.jpeg, .jpg, .png'],
                'label_attr' => ['class' => 'form-label'],
            ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'form-label'],
                'label' => 'Tags'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
        ]);
    }
}
