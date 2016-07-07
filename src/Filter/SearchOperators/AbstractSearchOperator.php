<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators;

use Doctrine\ORM\QueryBuilder;

abstract class AbstractSearchOperator implements SearchOperatorInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $property
     * @param mixed        $data
     * @param string       $propertyAlias
     *
     * @return \Doctrine\ORM\Query\Expr
     */
    abstract public function execute(QueryBuilder $queryBuilder, $property, $data, $propertyAlias = null);

    /** @var string */
    protected $operator;

    /**
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * @return string
     */
    public function generateUniqueParameterId()
    {
        return uniqid('uniquelibs_search_filter_');
    }
}