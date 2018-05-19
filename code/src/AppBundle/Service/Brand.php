<?php
namespace AppBundle\Service;

use AppBundle\Repository\BrandRepository;

class Brand
{
    /** @var  BrandRepository $brandRepository */
    private $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @param $id
     * @return null|object
     * @throws \Exception
     */
    public function getBrand($id)
    {
        $brand = $this->brandRepository->find($id);
        if (!$brand instanceof \AppBundle\Entity\Brand) {
            throw new \Exception("Brand not found.");
        }
        return $brand;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getBrands()
    {
        $brands = $this->brandRepository->findAll();
        if (!$brands|| sizeof($brands) < 1) {
            throw new \Exception("Brands not found.");
        }
        return $brands;
    }
}