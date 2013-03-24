<?php

namespace Sano\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, array(
                'attr' => array(
                    'placeholder'=>"Your news title..."
                ),
                'label' => 'Naslov'
            ));
        $builder->add('summary', 'textarea', array(
                'attr' => array(
                    'cols' => 40,
                    'rows' => 10
                ),
                'label' => 'Povzetek'
            ));
        $builder->add('text', 'textarea', array(
                'label' => 'Besedilo'
            ));
        $builder->add('status', 'choice', array(
                      'choices' => array('active' => 'Active', 
                                         'draft' => 'Draft')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sano\NewsBundle\Entity\News'
        ));
    }

    public function getName()
    {
        return 'sano_newsbundle_newstype';
    }
}
