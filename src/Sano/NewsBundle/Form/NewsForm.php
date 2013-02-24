<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Acme\DemoBundle\Entity\News;

class NewsForm extends AbstractType
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

    public function getName()
    {
        return 'contact';
    }
}
