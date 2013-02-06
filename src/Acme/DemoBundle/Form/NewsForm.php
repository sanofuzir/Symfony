<?php

namespace Acme\DemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'textarea');
        $builder->add('summary', 'textarea');
        $builder->add('text', 'textarea');
        $builder->add('status', 'choice', array(
                      'choices' => array('active' => 'Active', 
                                         'draft' => 'Draft')));
    }

    public function getName()
    {
        return 'contact';
    }
}
