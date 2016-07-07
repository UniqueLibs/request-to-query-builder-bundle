<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators;

use Doctrine\ORM\QueryBuilder;
use UniqueLibs\RequestToQueryBuilderBundle\Exception\InvalidSearchFilterSyntaxException;

class EqualOperator extends AbstractSearchOperator
{
    const OPERATOR = '=';

    public function __construct()
    {
        $this->operator = self::OPERATOR;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string       $property
     * @param mixed        $data
     * @param string       $propertyAlias
     *
     * @return \Doctrine\ORM\Query\Expr\Comparison
     * @throws InvalidSearchFilterSyntaxException
     */
    public function execute(QueryBuilder $queryBuilder, $property, $data, $propertyAlias = null)
    {
        if (!is_string($property) || !is_string($data)) {
            throw new InvalidSearchFilterSyntaxException(sprintf('Invalid syntax for %s operator.', self::OPERATOR));
        }

        $parameterId = $this->generateUniqueParameterId();

        $queryBuilder->setParameter($parameterId, trim($data, '\'"'));

        return $queryBuilder->expr()->eq($propertyAlias ? $propertyAlias : $property, ':'.$parameterId);
    }
}
