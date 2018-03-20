<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task')
            ->add('dueDate', DateType, array(
                'widget' => 'single_text',
                'label'  => 'Due Date',
                'required' => false
                ))
            ->add('agreeTerms', CheckboxType::class, array('mapped' => false))
            ->add('save', SubmitType::class)
        ;

        $form->get('agreeTerms')->getData();
        $form->get('agreeTerms')->setData(true);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Task::class,
        ));
    }


/*The form name is automatically generated from the type class name.
If you want to modify it, use the createNamed() method.
You can even suppress the name completely by setting it to an empty string.*/
}
