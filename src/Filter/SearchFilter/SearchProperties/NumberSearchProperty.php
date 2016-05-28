<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchProperties;

use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\EqualOperator;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\GreaterThanEqualOperator;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\GreaterThanOperator;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\LikeOperator;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\LowerThanEqualOperator;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\LowerThanOperator;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\NotEqualOperator;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\NotLikeOperator;

class NumberSearchProperty extends AbstractSearchProperty
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
            GreaterThanOperator::OPERATOR,
            GreaterThanEqualOperator::OPERATOR,
            LowerThanOperator::OPERATOR,
            LowerThanEqualOperator::OPERATOR,
        );
    }
}
