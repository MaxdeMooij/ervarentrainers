<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Class UserRegistrationType
 * @package AppBundle\Form
 * @author Willem Slaghekke <w.slaghekke@bytefusion.nl>
 */
class UserRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add(
                'plainPassword',
                RepeatedType::class,
                [
                    'type'           => PasswordType::class,
                    'first_options'  => ['label' => 'Password'],
                    'second_options' => ['label' => 'Repeat password'],
                ]
            )
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('phoneNumber', TextType::class)
            ->add('street', TextType::class)
            ->add('streetNumber', TextType::class)
            ->add('zipcode', TextType::class)
            ->add('city', TextType::class)
            ->add(
                'avatarFile',
                VichImageType::class,
                [
                    'imagine_pattern' => 'compress_only',
                ]
            )->add(
                'coverPhotoFile',
                VichImageType::class,
                [
                    'imagine_pattern' => 'compress_only',
                ]
            )->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
            ]
        );
    }


}