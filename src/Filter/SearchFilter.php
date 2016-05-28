<?php

namespace UniqueLibs\RequestToQueryBuilderBundle\Filter;

use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use PHPSQLParser\PHPSQLParser;
use Symfony\Component\HttpFoundation\Request;
use UniqueLibs\RequestToQueryBuilderBundle\Exception\InvalidSearchFilterSyntaxException;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchOperators\SearchOperatorInterface;
use UniqueLibs\RequestToQueryBuilderBundle\Filter\SearchFilter\SearchProperties\SearchPropertyInterface;
use UniqueLibs\RequestToQueryBuilderBundle\Helper\StringHelper;

class SearchFilter implements FilterInterface
{
    /** @var SearchOperatorInterface[] */
    protected $searchOperators;

    /** @var array[] */
    protected $searchProperties;

    /**
     * @param Request      $request
     * @param QueryBuilder $queryBuilder
     *
     * @return QueryBuilder
     * @throws InvalidSearchFilterSyntaxException
     */
    public function execute(Request $request, QueryBuilder $queryBuilder)
    {
        $result = $this->getParsedDataFromInput($request->get('query'), $queryBuilder);

        return $this->executeParsedInput($result, $queryBuilder);
    }
    
    /**
     * @param string       $string
     * @param QueryBuilder $queryBuilder
     *
     * @return QueryBuilder
     * @throws InvalidSearchFilterSyntaxException
     */
    public function executeString($string, QueryBuilder $queryBuilder)
    {
        $result = $this->getParsedDataFromInput($string, $queryBuilder);

        return $this->executeParsedInput($result, $queryBuilder);
    }
    
    /**
     * @param string       $result
     * @param QueryBuilder $queryBuilder
     *
     * @return QueryBuilder
     * @throws InvalidSearchFilterSyntaxException
     */
    public function executeParsedInput($result, QueryBuilder $queryBuilder)
    {
        if (is_null($result)) {
            return $queryBuilder;
        }
        
        $output = $this->parse($queryBuilder, $result);
        
        if (!is_null($output)) {
        	$queryBuilder->andWhere($output);
        }

        return $queryBuilder;
    }
    
    /**
     * @param QueryBuilder $queryBuilder
     * @param array        $result
     *
     * @return QueryBuilder
     * @throws InvalidSearchFilterSyntaxException
     */
    public function parse(QueryBuilder $queryBuilder, array $result)
    {
        $colref = null;
        $operator = array();
        $const = null;
        $condition = null;
        $expressions = array();
        
        $returnExpression = null;

        foreach ($result as $data) {
            if (!array_key_exists('expr_type', $data)) {
                throw new InvalidSearchFilterSyntaxException('Did not found expr_type in parsed result.');
            }
            
            if ($data['expr_type'] == 'bracket_expression') {
            	 if (!$data['sub_tree']) {
                    throw new InvalidSearchFilterSyntaxException('Subtree needed in bracket_expression.');
                }
                
                $output = $this->parse($queryBuilder, $data['sub_tree']);
                
                if (!is_null($output)) {
                	$expressions[] = $output;
                }
            } else if ($data['expr_type'] == 'colref') {
                if ($data['sub_tree']) {
                    throw new InvalidSearchFilterSyntaxException('Subtree not allowed in colref.');
                }

                if (!is_null($colref) || count($operator) || !is_null($const)) {
                    throw new InvalidSearchFilterSyntaxException('Invalid Syntax.');
                }

                if (!array_key_exists($data['base_expr'], $this->searchProperties)) {
                    throw new InvalidSearchFilterSyntaxException(sprintf('Given Proerty %s not found.', addslashes(substr($data['base_expr'], 0, 50))));
                }

                $colref = $data['base_expr'];
            } else if ($data['expr_type'] == 'operator') {
                if ($data['sub_tree']) {
                    throw new InvalidSearchFilterSyntaxException('Subtree not allowed in colref.');
                }
                
                $data['base_expr'] = strtoupper($data['base_expr']);

                if ($data['base_expr'] == '&&' || $data['base_expr'] == '||' || $data['base_expr'] == 'AND' || $data['base_expr'] == 'OR') {
                    if ($data['base_expr'] == '&&' || $data['base_expr'] == 'AND') {
                    	if (!is_null($condition) && $condition == 'OR') {
                    		throw new InvalidSearchFilterSyntaxException('Mixed AND - OR not allowed.');
                    	}
                    	
                    	$condition = 'AND';
                    } else {
                    	if (!is_null($condition) && $condition == 'AND') {
                    		throw new InvalidSearchFilterSyntaxException('Mixed AND - OR not allowed.');
                    	}
                    	
                    	$condition = 'OR';
                    }
                    
                    $colref = null;
                    $operator = array();
                    $const = null;

                } else {
                    if (is_null($colref) || !is_null($const)) {
                        throw new InvalidSearchFilterSyntaxException('Invalid Syntax.');
                    }

                    $operator[] = strtoupper($data['base_expr']);
                }


            } else if ($data['expr_type'] == 'const') {
                if ($data['sub_tree']) {
                    throw new InvalidSearchFilterSyntaxException('Subtree not allowed in colref.');
                }

                if (is_null($colref) || !count($operator) || !is_null($const)) {
                    throw new InvalidSearchFilterSyntaxException('Invalid Syntax.');
                }
               
                if (!array_key_exists(implode('_', $operator), $this->searchOperators)) {
                    throw new InvalidSearchFilterSyntaxException('Given search operator not found.');
                } 

                $allowedOperators = $this->searchProperties[$colref][1]->getAllowedOperators();

                if (!in_array(implode('_', $operator), $allowedOperators)) {
                    throw new InvalidSearchFilterSyntaxException(sprintf('Given search operator %s not allowed on property.', $data['base_expr']));
                }

                $const = $data['base_expr'];

                $expressions[] = $this->searchOperators[implode('_', $operator)]->execute($queryBuilder, $this->searchProperties[$colref][0], $data['base_expr']);
            }
        }
        
        if (count($expressions)) {
        	if (is_null($condition)) {
        		$condition = 'AND';
        	}
        	
        	if ($condition == 'AND') {
        		$returnExpression = call_user_func_array(array($queryBuilder->expr(), "andX"), $expressions);
        	} else if ($condition == 'OR') {
        		$returnExpression = call_user_func_array(array($queryBuilder->expr(), "orX"), $expressions);
        	}
        }
        
        return $returnExpression;
    }

    /**
     * @param string       $input
     * @param QueryBuilder $queryBuilder
     *
     * @return null
     * @throws InvalidSearchFilterSyntaxException
     */
    public function getParsedDataFromInput($input, QueryBuilder $queryBuilder)
    {
        if (!$input) {
            return null;
        }

        $parser = new PHPSQLParser();
        $result = $parser->parse($input);

        if (count($result) != 1 || !array_key_exists('WHERE', $result)) {
            throw new InvalidSearchFilterSyntaxException();
        }

        return $result['WHERE'];
    }

    /**
     * @param string                  $property
     * @param SearchPropertyInterface $searchProperty
     *
     * @return $this
     */
    public function addSearchProperty($property, SearchPropertyInterface $searchProperty)
    {
        $this->searchProperties[StringHelper::snake($property)] = array($property, $searchProperty);

        return $this;
    }

    /**
     * @param SearchOperatorInterface $searchOperator
     *
     * @return $this
     */
    public function addSearchOperator(SearchOperatorInterface $searchOperator)
    {
        $this->searchOperators[$searchOperator->getOperator()] = $searchOperator;

        return $this;
    }
}