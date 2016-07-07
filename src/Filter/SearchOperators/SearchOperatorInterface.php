<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators;

use Doctrine\ORM\QueryBuilder;

interface SearchOperatorInterface
{
    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $property
     * @param mixed        $data
     * @param string       $propertyAlias
     *
     * @return \Doctrine\ORM\Query\Expr
     */
    public function execute(QueryBuilder $queryBuilder, $property, $data, $propertyAlias = null);

    /**
     * @return string
     */
    public function getOperator();

    /**
     * @return string
     */
    public function generateUniqueParameterId();
}