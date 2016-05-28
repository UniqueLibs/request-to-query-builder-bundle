<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchProperties;

use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\EqualOperator;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\LikeOperator;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\NotEqualOperator;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\NotLikeOperator;

class StringSearchProperty extends AbstractSearchProperty
{
    /**
     * @return array
     */
    public function getAllowedOperators()
    {
        return array(
            EqualOperator::OPERATOR,
            NotEqualOperator::OPERATOR,
            LikeOperator::OPERATOR,
            NotLikeOperator::OPERATOR,
        );
    }
}
