<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 4/30/13
 * @version 1.0.0
 */

namespace FDevs\ArticleBundle\Document;

use Doctrine\Common\Util\Inflector;
use FDevs\ArticleBundle\Model\Article as BaseArticle;
use FOS\ElasticaBundle\Configuration\Search;
use FOS\ElasticaBundle\Transformer\HighlightableModelInterface;

/**
 * @Search(repositoryClass="FDevs\ArticleBundle\Document\SearchRepository\ArticleRepository")
 */
class Article extends BaseArticle implements HighlightableModelInterface
{
    /**
     * Set ElasticSearch highlight data.
     *
     * @param array $highlights array of highlight strings
     */
    public function setElasticHighlights(array $highlights)
    {
        foreach ($highlights as $property => $values) {
            $highlighted = implode("...", $values);
            if ($property == 'content') {
                $this
                    ->setDescription($highlighted)
                    ->setContent($highlighted)
                ;
            } else {
                $setter = 'set' . Inflector::classify($property);
                $reflection = new \ReflectionObject($this);
                if ($reflection->hasMethod($setter)) {
                    $this->{$setter}($highlighted);
                }
            }
        }
    }
}
