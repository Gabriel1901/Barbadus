<?php

namespace BarbadusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class BarbeiroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nome')
                ->add('telefone')
                ->add('sexo')
                ->add('dataNascimento', BirthdayType::class, array(
                    'format' => 'dd-MM-yyyy',
                    'label' => 'Data de Nascimento'
                ))
                ->add('servico');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BarbadusBundle\Entity\Barbeiro'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'barbadusbundle_barbeiro';
    }


}
