<?php

namespace Sano\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use sano\NewsBundle\Entity\News;

class sortNewsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('year', 'choice', array(
                      'choices' => array(
                                         '2013' => '2013', 
                                         '2012' => '2012')));
    }

    public function getName()
    {
        return 'contact';
    }
}
