<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Processor;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\FilterInterface;

class RequestProcessor
{
    /** @var FilterInterface[] */
    protected $filters;

    public function __construct()
    {
        $this->filters = array();
    }

    /**
     * @param FilterInterface $filterInterface
     *
     * @return RequestProcessor
     */
    public function addFilter(FilterInterface $filterInterface)
    {
        $this->filters[] = $filterInterface;

        return $this;
    }

    /**
     * @param Request      $request
     * @param QueryBuilder $queryBuilder
     *
     * @return QueryBuilder
     */
    public function execute(Request $request, QueryBuilder $queryBuilder)
    {
        foreach ($this->filters as $filter) {
            $filter->execute($request, $queryBuilder);
        }

        return $queryBuilder;
    }
}