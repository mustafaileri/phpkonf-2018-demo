<?php

namespace AppBundle\Controller;

use AppBundle\Service\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ProductController extends Controller
{
    /**
     * @Route("/products", name="products")
     */

    public function indexAction()
    {
        /** @var Product $productService */
        $productService = $this->get('product_service');
        $products = $productService->getProducts();
        return $this->render('AppBundle:Product:index.html.twig', ["products" => $products]);
    }

    /**
     * @Route("/products/{id}", name="product_detail")
     */

    public function detailAction($id)
    {
        /** @var Product $productService */
        $productService = $this->get('product_service');
        try {
            $productData = $productService->getProduct($id);
            return $this->render('AppBundle:Product:detail.html.twig', ["data" => $productData]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


    }
}