<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchProperties;

abstract class AbstractSearchProperty implements SearchPropertyInterface
{
    /**
     * @return array
     */
    abstract public function getAllowedOperators();

    /**
     * @param string $input
     *
     * @return mixed
     */
    public function getDataByInput($input)
    {
        return $input;
    }
}