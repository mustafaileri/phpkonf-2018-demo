<?php
namespace AppBundle\Service;

use AppBundle\Repository\CategoryRepository;

class Category
{
    /** @var  CategoryRepository $categoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param $id
     * @return null|object
     * @throws \Exception
     */
    public function getCategory($id)
    {
        $category = $this->categoryRepository->find($id);
        if (!$category instanceof \AppBundle\Entity\Category) {
            throw new \Exception("Category not found.");
        }
        return $category;
    }

    /**
     * @throws \Exception
     */
    public function getCategories()
    {
        $categories = $this->categoryRepository->findAll();
        if (!$categories|| sizeof($categories) < 1) {
            throw new \Exception("Categories not found.");
        }
        return $categories;
    }
}