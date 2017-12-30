<?php

namespace AppBundle\Form;

use FOS\UserBundle\Form\Type\ProfileFormType;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $builder->add('firstName');
      $builder->add('lastName');
      $builder->add('email', EmailType::class, ['label' => 'form.email', 'translation_domain' => 'FOSUserBundle']);
      $builder->add('phoneNumber', TextType::class);
      $builder->add('street', TextType::class);
      $builder->add('streetNumber', TextType::class);
      $builder->add('zipcode', TextType::class);
      $builder->add('city', TextType::class);
      $builder->add('geslacht', ChoiceType::class, [
          'choices' => [
              'male',
              'female'     ]
      ]);
      // Gender isn't a checkbox.. but a dropdown.. CheckboxType doesn't work. Am I crazy?
      $builder->add(
          'avatarFile',
          VichImageType::class,
          [
              // compress_only doesn't work
              'required'=> false
          ]
      );
      $builder->add('typeTrainer', TextType::class);
      $builder->add('motto', TextType::class);
      $builder->add('description', TextType::class); // This needs to be a textarea
      $builder->add('ervaring', TextType::class); // Has to be a number
      // $builder->add('vog', CheckboxType::class); Does not work

    }

    public function getParent()
    {
        return 'fos_user_edit';
    }

    public function getName()
    {
        return 'app_user_edit';
    }
}
