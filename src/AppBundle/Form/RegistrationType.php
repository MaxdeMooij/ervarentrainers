<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

/**
 * Class UserRegistrationType
 * @package AppBundle\Form
 * @author Willem Slaghekke <w.slaghekke@bytefusion.nl>
 */
class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, ['label' => 'form.email', 'translation_domain' => 'FOSUserBundle'])
            ->add(
                'plainPassword',
                RepeatedType::class,
                [
                    'type'            => PasswordType::class,
                    'options'         => ['translation_domain' => 'FOSUserBundle'],
                    'first_options'   => ['label' => 'form.password'],
                    'second_options'  => ['label' => 'form.password_confirmation'],
                    'invalid_message' => 'fos_user.password.mismatch',
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
                    'required'=> false
                ]
            )->add(
                'coverPhotoFile',
                VichImageType::class,
                [
                    'imagine_pattern' => 'compress_only',
                    'required'=> false
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
            ]
        );
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }
}