<?php

namespace AppBundle\Controller;

use AppBundle\Service\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/categories", name="categories")
     */
    public function indexAction()
    {
        /** @var Category $categoryService */
        $categoryService = $this->get("category_service");

        try {
            $categories = $categoryService->getCategories();
            return $this->render('AppBundle:Category:index.html.twig', ["categories" => $categories]);
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

    /**
     * @Route("categories/{id}", name="category_detail")
     */
    public function detailAction($id)
    {
        /** @var Category $categoryService */
        $categoryService = $this->get('category_service');
        try {
            $categoryData = $categoryService->getCategory($id);
            return $this->render('AppBundle:Category:detail.html.twig', ["data" => $categoryData]);
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

}
