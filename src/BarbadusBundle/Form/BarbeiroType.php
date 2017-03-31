<?php

namespace BarbadusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class BarbeiroType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nome')
                ->add('servico')
                
                ->add('sexo', ChoiceType::class, array(
                    'choices'  => array(
                        "Masculino" => "M",
                        "Feminino" => "F",
                        "Indefinido" => "I"
                    ),
                    'expanded' => true,
                    'multiple'=> false
                ))
                ->add('dataNascimento', BirthdayType::class, array(
                    'format' => 'dd-MM-yyyy',
                    'label' => 'Data de Nascimento'
                ))
                ->add('telefone');
                
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
