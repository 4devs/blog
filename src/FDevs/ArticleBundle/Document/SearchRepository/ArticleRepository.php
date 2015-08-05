<?php

namespace FDevs\ArticleBundle\Document\SearchRepository;

use Elastica\Query;
use Elastica\Query\Match;
use Elastica\Query\MatchAll;
use FDevs\ArticleBundle\Model\ArticleSearch;
use FOS\ElasticaBundle\Repository;

class ArticleRepository extends Repository
{
    /**
     * @param ArticleSearch $articleSearch
     *
     * @return Query|Match|MatchAll
     */
    public function getQueryForSearch(ArticleSearch $articleSearch)
    {
        $text = $articleSearch->getText();
        $boolQuery = new Query\Bool();
        if (!is_null($text) && $text !== '') {
            $query = new Query\MultiMatch();
            $query
                ->setOperator('or')
                ->setFields(['article.title^2', 'article.content'])
                ->setQuery($text)
                ->setFuzziness(0.7)
                ->setMinimumShouldMatch('80%')
            ;
        } else {
            $query = new MatchAll();
        }
        $boolQuery
            ->addMust($query)
            ->addMust(new Query\Terms('publish', [true]))
        ;
        $query = new Query($boolQuery);
        $query
            ->setHighlight([
                "tags_schema" => "styled",
                'fields' => [
                    'title' => [
                        "number_of_fragments" => 0,
                    ],
                    'content' => new \stdClass(),
                ],
            ])
        ;

        return $query;
    }
}
