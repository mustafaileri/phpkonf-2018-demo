<?php
namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Product;
use AppBundle\Repository\BrandRepository;
use AppBundle\Repository\CategoryRepository;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadProductData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public
    function load(ObjectManager $manager)
    {
        /** @var CategoryRepository $categoryRepository */
        $categoryRepository = $this->container->get("category_repository");

        /** @var BrandRepository $brandRepository */
        $brandRepository = $this->container->get("brand_repository");

        $categories = $categoryRepository->findAll();
        $brands = $brandRepository->findAll();

        for ($i = 0; $i <= 100; $i++) {
            $sampleProduct = new Product();
            $name = "Product_" . $i;
            $description = "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..." . $i;
            $price = rand(1, 1000000);
            if (($i % 10) != 0) {
                $sampleProduct->setCategory($categories[($i % 10)]);
            }

            if (($i % 5) != 0) {
                $sampleProduct->setBrand($brands[($i % 5)]);
            }

            $sampleProduct->setName($name)->setDescription($description)->setPrice($price);
            $manager->persist($sampleProduct);
        }
        $manager->flush();
    }

    public
    function getOrder()
    {
        return 3;
    }

}