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

class CategoryAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('title')
            ->add('parent', 'sonata_type_model', array('required' => false,));
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
            ->add('parent.title', null, array('label' => 'Parent'))
            ->add('createdAt', null, array('label' => 'Created'));
    }
}
