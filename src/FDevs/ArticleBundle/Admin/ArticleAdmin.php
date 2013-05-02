<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/1/13
 * @version 1.0.0
 */

namespace FDevs\ArticleBundle\Admin;


use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ArticleAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', 'text', array('label' => 'Uri'))
            ->add('title')
            ->add('content', 'textarea', array('required' => false, 'attr' => array('class' => 'ckeditor')))
            ->add('publish', null, array('required' => false))
            ->add('publishedAt', null, array('required' => false))
            ->add('authors')
            ->add('categories', 'sonata_type_model', array('required' => true, 'multiple' => true, 'compound' => false))
            ->add('tags', 'sonata_type_model', array('required' => false, 'multiple' => true, 'compound' => false));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array('label' => 'Title'), 'text')
            ->add('id', null, array('label' => 'Uri'), 'text');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('id', null, array('label' => 'Uri'))
            ->add('categories', null, array('label' => 'Categories'))
            ->add('publish', null, array('label' => 'Publish'))
            ->add('createdAt', null, array('label' => 'Created'));
    }

}