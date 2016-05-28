<?php

namespace UniqueLibs\RequestToQueryBuilderTestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="UniqueLibs\RequestToQueryBuilderTestBundle\Entity\ProductRepository")
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", options={"unsigned"=true})
     */
    private $status;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", name="active")
     */
    private $active;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="camel_case")
     */
    private $camelCase;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name", length=64)
     */
    private $name;

    /**
     * @param null|int $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getCamelCase()
    {
        return $this->camelCase;
    }

    /**
     * @param int $camelCase
     */
    public function setCamelCase($camelCase)
    {
        $this->camelCase = $camelCase;
    }
}
