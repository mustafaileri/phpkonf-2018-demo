<?php
namespace Tests\AppBundle\Service;


use AppBundle\Repository\CategoryRepository;
use AppBundle\Service\Category;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryTest extends WebTestCase
{
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $categoryRepositoryMock;

    public function setUp()
    {
        $this->categoryRepositoryMock = $this->getMockBuilder(CategoryRepository::class)->disableOriginalConstructor()->setMethods(["find", "findAll"])->getMock();
    }

    public function testGetCategory()
    {
        $mockCategoryEntity = new \AppBundle\Entity\Category();
        $mockCategoryEntity->setName("Test")->setSlugUrl("test");
        $this->categoryRepositoryMock->expects($this->any())->method("find")->with(1)->willReturn($mockCategoryEntity);

        $categoryService = new Category($this->categoryRepositoryMock);
        /** @var \AppBundle\Entity\Category $res */
        $res = $categoryService->getCategory(1);
        $this->assertInstanceOf('\AppBundle\Entity\Category', $res);
        $this->assertTrue($res->getName() == "Test");
        $this->assertTrue($res->getSlugUrl() == "test");
    }

    public function testGetCategoryFail()
    {
        $this->categoryRepositoryMock->expects($this->any())->method("find")->with(2)->willThrowException(new \Exception("Category not found."));
        $categoryService = new Category($this->categoryRepositoryMock);

        $this->setExpectedException("\Exception");
        /** @var \AppBundle\Entity\Category $res */
        $categoryService->getCategory(2);
    }

    public function testGetCategories()
    {
        $category1 = new \AppBundle\Entity\Category();
        $category1->setName("test")->setSlugUrl("test");

        $category2 = new \AppBundle\Entity\Category();
        $category2->setName("test2")->setSlugUrl("test2");

        $data = new ArrayCollection([$category1, $category2]);
        $this->categoryRepositoryMock->expects($this->at(0))->method("findAll")->willReturn($data);
        $this->categoryRepositoryMock->expects($this->at(1))->method("findAll")->willThrowException(new \Exception("Category not found."));
        $categoryService = new Category($this->categoryRepositoryMock);
        $returnData = $categoryService->getCategories();
        $this->assertEquals(2, sizeof($returnData));

        $this->setExpectedException("\Exception");
        $categoryService->getCategories();
    }
}