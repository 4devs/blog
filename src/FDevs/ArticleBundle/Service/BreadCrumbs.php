<?php
namespace FDevs\ArticleBundle\Service;

use FDevs\ArticleBundle\Service\SingleBreadCrumbs;


class BreadCrumbs
{
    public $breadcrumbs = array();
    public $allBreadCrumbs = array();
    public $separator;
    public $selectedClass;

    public function __construct($separator, $selectedClass)
    {
        $this->separator = $separator;
        $this->selectedClass = $selectedClass;
    }

    public function addItem($text, $link)
    {

        $item = new SingleBreadCrumbs($text, $link);
        $this->breadcrumbs[] = $item;

        return $this;
    }


    public function getBreadCrumbs()
    {

        $i = 0;
        foreach ($this->breadcrumbs as $key => $value) {
            $i++;
            $this->allBreadCrumbs[$key]['title'] = $value->text;
            $this->allBreadCrumbs[$key]['link'] = $value->url;
            if ($i != count($this->breadcrumbs)) {
                $this->allBreadCrumbs[$key]['separator'] = $this->separator;
            } else {
                $this->allBreadCrumbs[$key]['class'] = $this->selectedClass;
            }
        }

        return $this->allBreadCrumbs;
    }
}