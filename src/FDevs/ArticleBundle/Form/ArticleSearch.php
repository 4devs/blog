<?php

namespace FDevs\ArticleBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleSearch extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', 'text', array(
            'label' => 'Найти',
            'required' => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => 'FDevs\ArticleBundle\Model\ArticleSearch',
            'method' => 'GET',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fdevs_article_search';
    }

}
