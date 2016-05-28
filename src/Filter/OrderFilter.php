<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Filter;

use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;
use UniqueLibs\RequestToQueryBuilderBundle\Helper\StringHelper;

class OrderFilter implements FilterInterface
{
    /** @var array */
    protected $orderProperties;

    /**
     * @param Request      $request
     * @param QueryBuilder $queryBuilder
     *
     * @return QueryBuilder
     */
    public function execute(Request $request, QueryBuilder $queryBuilder)
    {
        $filteredProperties = array();

        $sort = $request->get('sort');

        if (!is_null($sort) && !is_array($sort)) {
            $elements = explode(',', $sort, 99);

            foreach ($elements as $element) {
                if ($element) {
                    $sort = 'asc';

                    if (substr($element, 0, 1) == '+') {
                        $element = substr($element, 1);
                    } else if (substr($element, 0, 1) == '-') {
                        $element = substr($element, 1);
                        $sort = 'desc';
                    }

                    if (array_key_exists($element, $this->orderProperties)) {
                        $filteredProperties[] = $element;
                        $queryBuilder->addOrderBy($this->orderProperties[$element][0], $sort);
                    }
                }
            }
        }

        foreach ($this->orderProperties as $property => $value) {
            if (!array_key_exists($property, $filteredProperties)) {
                if (!is_null($value[1])) {
                    $queryBuilder->addOrderBy($value[0], $value[1]);
                }
            }
        }

        return $queryBuilder;
    }

    /**
     * @param string      $property
     * @param null|string $defaultOrder
     *
     * @return $this
     * @throws \Exception
     */
    public function addOrderProperty($property, $defaultOrder = null)
    {
        if (!is_null($defaultOrder)) {
            $defaultOrder = strtolower($defaultOrder);

            if ($defaultOrder != 'asc' && $defaultOrder != 'desc') {
                throw new \Exception('DefaultOrder needs to be null or asc/desc.');
            }
        }

        $this->orderProperties[StringHelper::snake($property)] = array($property, $defaultOrder);

        return $this;
    }
}