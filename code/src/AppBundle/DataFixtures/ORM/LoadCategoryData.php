<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Category;
use Cocur\Slugify\Slugify;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $slugify = new Slugify();
        for ($i = 0; $i <= 10; $i++) {
            $sampleCategory = new Category();
            $name = "Category_" . $i;
            $sampleCategory->setName($name)->setSlugUrl($slugify->slugify($name));
            $manager->persist($sampleCategory);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

}