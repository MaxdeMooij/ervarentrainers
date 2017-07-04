<?php

namespace AppBundle\Form;

use AppBundle\Entity\TrainingPrice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TrainingPriceType
 * @package AppBundle\Form
 * @author Willem Slaghekke <w.slaghekke@bytefusion.nl>
 */
class TrainingPriceType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', TextType::class)
            ->add('price', NumberType::class, [
                'scale' => 2
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TrainingPrice::class
        ]);
    }

}