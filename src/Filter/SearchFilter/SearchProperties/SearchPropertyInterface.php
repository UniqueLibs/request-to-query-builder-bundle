<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchProperties;

interface SearchPropertyInterface
{
    /**
     * @return array
     */
    public function getAllowedOperators();

    /**
     * @param string $input
     *
     * @return mixed
     */
    public function getDataByInput($input);
}