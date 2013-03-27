<?php

namespace Sano\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sano\BlogBundle\Entity\Comment'
        ));
    }

    public function getName()
    {
        return 'contact';
    }
}
