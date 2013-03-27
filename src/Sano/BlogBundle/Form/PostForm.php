<?php

namespace Sano\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, array(
                'attr' => array(
                    'placeholder'=>"Naslov objave"
                ),
                'label' => 'Naslov'
            ));
        $builder->add('text', 'textarea', array(
                'label' => 'Besedilo'
            ));
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sano\BlogBundle\Entity\Post'
        ));
    }
    
    public function getName()
    {
        return 'sano_blogbundle_postform';
    }
}
