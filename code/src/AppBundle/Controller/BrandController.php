<?php

namespace AppBundle\Controller;

use AppBundle\Service\Brand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BrandController extends Controller
{
    /**
     * @Route("/brands", name="brands")
     */
    public function indexAction()
    {
        /** @var Brand $brandService */
        $brandService = $this->get("brand_service");

        try {
            $brands = $brandService->getBrands();
            return $this->render('AppBundle:Brand:index.html.twig', ["brands" => $brands]);
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

    /**
     * @Route("brands/{id}", name="brand_detail")
     */
    public function detailAction($id)
    {
        /** @var Brand $brandService */
        $brandService = $this->get('brand_service');
        try {
            $brandData = $brandService->getBrand($id);
            return $this->render('AppBundle:Brand:detail.html.twig', ["data" => $brandData]);
        } catch (\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }

}
