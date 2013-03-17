<?php

namespace Sano\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use sano\BlogBundle\Entity\Post;

class PostForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, array(
                'attr' => array(
                    'placeholder'=>"Your post title..."
                ),
                'label' => 'Naslov'
            ));
        $builder->add('text', 'textarea', array(
                'label' => 'Besedilo'
            ));
    }

    public function getName()
    {
        return 'contact';
    }
}
