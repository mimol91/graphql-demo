<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var bool
     *
     * @ORM\Column(name="promo", type="boolean")
     */
    private $promo;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Category", mappedBy="products")
     */
    private $categories;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Product")
     */
    private $similarProducts;


    public function __construct()
    {
        $this->promo = false;
        $this->categories = new ArrayCollection();
        $this->similarProduts= new ArrayCollection();
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param integer $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param boolean $promo
     *
     * @return Product
     */
    public function setPromo($promo)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * @return bool
     */
    public function isPromo()
    {
        return $this->promo;
    }

    /**
     * Get promo
     *
     * @return boolean
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @param Category $category
     *
     * @return Product
     */
    public function addCategory(Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * @param Category $category
     * @return Product
     */
    public function removeCategory(Category $category)
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Product $similarProduct
     *
     * @return Product
     */
    public function addSimilarProduct(Product $similarProduct)
    {
        $this->similarProducts[] = $similarProduct;
        $similarProduct->addSimilarProduct($this);

        return $this;
    }

    /**
     * @param Product $similarProduct
     * @return Product
     */
    public function removeSimilarProduct(Product $similarProduct)
    {
        $this->similarProducts->removeElement($similarProduct);
        $similarProduct->removeSimilarProduct($this);

        return $this;
    }

    /**
     * @return Collection
     */
    public function getSimilarProducts()
    {
        return $this->similarProducts;
    }
}
