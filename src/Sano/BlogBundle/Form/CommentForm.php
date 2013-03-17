<?php

namespace Sano\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use sano\BlogBundle\Entity\Comment;

class CommentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', null, array(
                'attr' => array(
                    'placeholder'=>"Your name..."
                ),
                'label' => 'Ime'
            ));
        $builder->add('comment', 'textarea', array(
                'label' => 'Besedilo'
            ));
    }

    public function getName()
    {
        return 'contact';
    }
}
