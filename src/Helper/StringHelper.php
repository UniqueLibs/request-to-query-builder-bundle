<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Helper;

class StringHelper
{
    /**
     * @param string $string
     *
     * @return string
     * @throws \Exception
     */
    public static function snake($string)
    {
        $parts = array_map(
            function ($part) {
                return strtolower($part);
            },
            self::getParts($string)
        );
        
        return join('_', $parts);
    }

    /**
     * @param string $string
     *
     * @return string
     * @throws \Exception
     */
    private static function getParts($string)
    {
        if (!is_string($string)) {
            throw new \Exception("Needs to be a string.");
        }

        $string = trim($string);

        if (strpos($string, '/') !== false) {
            return preg_split('/\//', $string);
        }

        // snake case
        if (strpos($string, '_') !== false) {
            return preg_split('/_/', $string);
        }

        return preg_split('/(?<=.)(?=[A-Z]([^A-Z]|$))/', $string);
    }
}