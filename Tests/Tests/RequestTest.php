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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id = ?',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id = ?'
        ));
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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id <> ?',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id <> ?'
        ));
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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id > ?',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id > ?'
        ));
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

        $client->request('GET', '/products/?query=' . urlencode("where product.id < 3"));

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id < ?',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id < ?'
        ));
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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id >= ?',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id >= ?'
        ));
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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id <= ?',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND p0_.id <= ?'
        ));
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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.name LIKE ?',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND p0_.name LIKE ?'
        ));
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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.name NOT LIKE ?',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND p0_.name NOT LIKE ?'
        ));
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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND (p0_.id = ? OR p0_.name <> ?)',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND (p0_.id = ? OR p0_.name <> ?)'
        ));
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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND ((p0_.id = ? OR p0_.id <> ?) OR p0_.name = ?)',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND ((p0_.id = ? OR p0_.id <> ?) OR p0_.name = ?)'
        ));
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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND (((p0_.id = ? OR p0_.id <> ?) OR p0_.name = ?) AND p0_.id = ?)',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND (((p0_.id = ? OR p0_.id <> ?) OR p0_.name = ?) AND p0_.id = ?)'
        ));
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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 AND p0_.camel_case = ?',
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 AND p0_.camel_case = ?'
        ));
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

        $this->assertContains($client->getResponse()->getContent(), array(
            'SELECT p0_.id AS id0, p0_.status AS status1, p0_.active AS active2, p0_.camel_case AS camel_case3, p0_.name AS name4 FROM products p0_ WHERE p0_.active = 1 ORDER BY p0_.camel_case DESC',
            'SELECT p0_.id AS id_0, p0_.status AS status_1, p0_.active AS active_2, p0_.camel_case AS camel_case_3, p0_.name AS name_4 FROM products p0_ WHERE p0_.active = 1 ORDER BY p0_.camel_case DESC'
        ));
    }
}