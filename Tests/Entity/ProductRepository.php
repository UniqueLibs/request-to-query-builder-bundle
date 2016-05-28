<?php

namespace UniqueLibs\RequestToQueryBuilderTestBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->createQueryBuilder('product')
            ->andWhere('product.active = 1');
    }
}