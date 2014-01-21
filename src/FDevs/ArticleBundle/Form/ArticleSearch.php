<?php

namespace FDevs\ArticleBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class ArticleSearch extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('search_phrase', 'text', array(
            'label' => 'Найти',
            'required' => true,
        ));
    }

    public function getName()
    {
        return 'fdevs_article_search';
    }

}
