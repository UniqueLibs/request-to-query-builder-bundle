<?php

namespace UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UniqueLibs\RequestToQueryBuilderTestBundle\Entity\Product;

class LoadProductData
    extends AbstractFixture
    implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName("First Product");
        $product->setActive(true);
        $product->setStatus(1);
        $product->setCamelCase(5);

        $manager->persist($product);

        $product = new Product();
        $product->setName("Second Product");
        $product->setActive(true);
        $product->setStatus(2);
        $product->setCamelCase(10);

        $manager->persist($product);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}