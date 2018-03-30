<?php
/**
 * Created by PhpStorm.
 * User: denni
 * Date: 30.03.2018
 * Time: 05:17
 */
// src/Admin/CategoryAdmin.php
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\DateType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Content')
                ->add('title', TextType::class)
                ->add('content', TextType::class)
            ->end()
            ->with('Data')
                ->add('publishDate', DateType::class)
/*                ->add('user', ModelType::class, [
                    'class' => User::class,
                    'property' => 'name'
                ])*/
                ->add('user', EntityType::class, [
                    'class' => User::class,
                    'choice_label' => 'name',
                ])
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
            $datagridMapper
                ->add('title')
//                ->add('publishDate', null, [], DateType::class, [])
/*                ->add('user', null, [], EntityType::class, [
                    'class'    => User::class,
                    'choice_label' => 'name',
                ]);*/
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('publishDate')
            ->add('user');
    }
}