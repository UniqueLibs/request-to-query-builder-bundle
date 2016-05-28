<?php

namespace UniqueLibs\RequestToQueryBuilderTestBundle\Tests;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class RequestTest extends WebTestCase
{
    public function testProductIdEquals()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where product.id = 1"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id = ?',
            $client->getResponse()->getContent()
        );
    }

    public function testProductIdNotEquals()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where product.id != 1"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id <> ?',
            $client->getResponse()->getContent()
        );
    }

    public function testProductIdBiggerThen()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where product.id > 3"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id > ?',
            $client->getResponse()->getContent()
        );
    }

    public function testProductIdLowerThen()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where product.id < 3"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id < ?',
            $client->getResponse()->getContent()
        );
    }

    public function testProductIdBiggerThenEquals()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where product.id >= 3"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id >= ?',
            $client->getResponse()->getContent()
        );
    }

    public function testProductIdLowerThenEquals()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where product.id <= 3"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id <= ?',
            $client->getResponse()->getContent()
        );
    }

    public function testProductNameIsLike()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where product.name LIKE '%test%'"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.name LIKE ?',
            $client->getResponse()->getContent()
        );
    }

    public function testProductNameIsNotLike()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where product.name NOT LIKE '%test%'"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.name NOT LIKE ?',
            $client->getResponse()->getContent()
        );
    }

    public function testNasted1()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where product.id = 1 || product.name != 'test'"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND (p0_.id = ? OR p0_.name <> ?)',
            $client->getResponse()->getContent()
        );
    }

    public function testNasted2()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where (product.id = 1 || product.id != 2) || product.name = 'test'"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND ((p0_.id = ? OR p0_.id <> ?) OR p0_.name = ?)',
            $client->getResponse()->getContent()
        );
    }

    public function testNasted3()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where ((product.id = 1 || product.id != 2) || product.name = 'test') AND product.id = 5"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND (((p0_.id = ? OR p0_.id <> ?) OR p0_.name = ?) AND p0_.id = ?)',
            $client->getResponse()->getContent()
        );
    }

    public function testCamelCase()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?query='.urlencode("where product.camel_case = 5"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.camel_case = ?',
            $client->getResponse()->getContent()
        );
    }

    public function testCamelCaseOrder()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(array(
            'UniqueLibs\RequestToQueryBuilderTestBundle\DataFixtures\ORM\LoadProductData'
        ));

        // you can now run your functional tests with a populated database
        $client = static::createClient();

        $client->request('GET', '/products/?sort='.urlencode("-product.camel_case"));

        $this->assertEquals(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 ORDER BY p0_.camel_case DESC',
            $client->getResponse()->getContent()
        );
    }
}