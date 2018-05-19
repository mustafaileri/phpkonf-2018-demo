<?php
namespace Tests\AppBundle\Service;


use AppBundle\Repository\ProductRepository;
use AppBundle\Service\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductTest extends WebTestCase
{
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $productRepositoryMock;

    public function setUp()
    {
        $this->productRepositoryMock = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->setMethods(["find", "findAll"])->getMock();
    }

    public function testGetProduct()
    {
        $mockProductEntity = new \AppBundle\Entity\Product();
        $mockProductEntity->setName("Test");
        $this->productRepositoryMock->expects($this->any())->method("find")->with(1)->willReturn($mockProductEntity);

        $productService = new Product($this->productRepositoryMock);
        /** @var \AppBundle\Entity\Product $res */
        $res = $productService->getProduct(1);
        $this->assertInstanceOf('\AppBundle\Entity\Product', $res);
        $this->assertTrue($res->getName() == "Test");
    }

    public function testGetProductFail()
    {
        $this->productRepositoryMock->expects($this->any())->method("find")->with(2)->willThrowException(new \Exception("Product not found."));
        $productService = new Product($this->productRepositoryMock);

        $this->setExpectedException("\Exception");
        /** @var \AppBundle\Entity\Product $res */
        $productService->getProduct(2);
    }

    public function testGetProducts()
    {
        $product1 = new \AppBundle\Entity\Product();
        $product1->setName("test");

        $product2 = new \AppBundle\Entity\Product();
        $product2->setName("test2");

        $data = new ArrayCollection([$product1, $product2]);
        $this->productRepositoryMock->expects($this->at(0))->method("findAll")->willReturn($data);
        $this->productRepositoryMock->expects($this->at(1))->method("findAll")->willThrowException(new \Exception("Product not found."));
        $productService = new Product($this->productRepositoryMock);
        $returnData = $productService->getProducts();
        $this->assertEquals(2, sizeof($returnData));

        $this->setExpectedException("\Exception");
        $productService->getProducts();
    }
}