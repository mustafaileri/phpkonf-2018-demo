<?php
namespace Tests\AppBundle\Service;


use AppBundle\Repository\BrandRepository;
use AppBundle\Service\Brand;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BrandTest extends WebTestCase
{
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $brandRepositoryMock;

    public function setUp()
    {
        $this->brandRepositoryMock = $this->getMockBuilder(BrandRepository::class)->disableOriginalConstructor()->setMethods(["find", "findAll"])->getMock();
    }

    public function testGetBrand()
    {
        $mockBrandEntity = new \AppBundle\Entity\Brand();
        $mockBrandEntity->setName("Test")->setSlugUrl("test");
        $this->brandRepositoryMock->expects($this->any())->method("find")->with(1)->willReturn($mockBrandEntity);

        $brandService = new Brand($this->brandRepositoryMock);
        /** @var \AppBundle\Entity\Brand $res */
        $res = $brandService->getBrand(1);
        $this->assertInstanceOf('\AppBundle\Entity\Brand', $res);
        $this->assertTrue($res->getName() == "Test");
        $this->assertTrue($res->getSlugUrl() == "test");
    }

    public function testGetBrandFail()
    {
        $this->brandRepositoryMock->expects($this->any())->method("find")->with(2)->willThrowException(new \Exception("Brand not found."));
        $brandService = new Brand($this->brandRepositoryMock);

        $this->setExpectedException("\Exception");
        /** @var \AppBundle\Entity\Brand $res */
        $brandService->getBrand(2);
    }

    public function testGetBrands()
    {
        $brand1 = new \AppBundle\Entity\Brand();
        $brand1->setName("test")->setSlugUrl("test");

        $brand2 = new \AppBundle\Entity\Brand();
        $brand2->setName("test2")->setSlugUrl("test2");

        $data = new ArrayCollection([$brand1, $brand2]);
        $this->brandRepositoryMock->expects($this->at(0))->method("findAll")->willReturn($data);
        $this->brandRepositoryMock->expects($this->at(1))->method("findAll")->willThrowException(new \Exception("Brand not found."));
        $brandService = new Brand($this->brandRepositoryMock);
        $returnData = $brandService->getBrands();
        $this->assertEquals(2, sizeof($returnData));

        $this->setExpectedException("\Exception");
        $brandService->getBrands();
    }
}