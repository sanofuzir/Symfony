<?php

namespace Sano\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use sano\NewsBundle\Entity\News;

class arhiveNewsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('year', 'choice', array(
                      'choices' => array(
                                         '2013' => '2013', 
                                         '2012' => '2012')));
        $builder->add('month', 'choice', array(
                      'choices' => array(
                                         '1' => 'januar', 
                                         '2' => 'februar')));
    }

    public function getName()
    {
        return 'contact';
    }
}
