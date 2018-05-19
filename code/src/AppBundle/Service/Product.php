<?php
namespace AppBundle\Service;

use AppBundle\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;

class Product
{
    /** @var  ProductRepository $productRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param $id
     * @return null|object
     * @throws \Exception
     */
    public function getProduct($id)
    {
        $product = $this->productRepository->find($id);
        if (!$product instanceof \AppBundle\Entity\Product) {
            throw new \Exception("Product not found.");
        }
        return $product;
    }

    /**
     * @throws \Exception
     */
    public function getProducts()
    {
        $products = $this->productRepository->findAll();
        if (!$products || sizeof($products) < 1) {
            throw new \Exception("Products not found.");
        }
        return $products;
    }

    /**
     * @param $categoryId
     * @throws \Exception
     */
    public function getProductsByCategory($categoryId)
    {
        $categoryProducts = $this->productRepository->findBy(["category" => $categoryId]);

        if (!$categoryProducts || !$categoryProducts instanceof ArrayCollection || $categoryProducts->count() < 1) {
            throw new \Exception("Products not found for this category.");
        }
    }

    /**
     * @param $brandId
     * @throws \Exception
     */
    public function getProductsByBrand($brandId)
    {
        $brandProducts = $this->productRepository->findBy(["brand" => $brandId]);

        if (!$brandProducts || !$brandProducts instanceof ArrayCollection || $brandProducts->count() < 1) {
            throw new \Exception("Products not found for this brand.");
        }
    }
}
