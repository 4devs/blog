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
    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'publishedAt'
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id', 'text', array('label' => 'Uri'))
            ->add('title')
            ->add('content', 'textarea', array('required' => false, 'attr' => array('class' => 'ckeditor')))
            ->with('Authors')->add('authors')->end()
            ->with('Publish')
                ->add('publish', null, array('required' => false))
                ->add('publishedAt', null, array('required' => false))
            ->end()
            ->add('locale', 'locale', array('preferred_choices' => array('ru', 'en', 'de')))
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
            ->add('publish', 'boolean', array('label' => 'Publish'))
            ->add('publishedAt', 'datetime', array('label' => 'Published'));
    }

}
