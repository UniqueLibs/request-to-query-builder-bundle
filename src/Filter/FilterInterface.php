<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Filter;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;

interface FilterInterface
{
    /**
     * @param Request      $request
     * @param QueryBuilder $queryBuilder
     *
     * @return mixed
     */
    public function execute(Request $request, QueryBuilder $queryBuilder);
}