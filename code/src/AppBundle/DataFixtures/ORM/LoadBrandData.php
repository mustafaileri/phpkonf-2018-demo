<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Brand;
use Cocur\Slugify\Slugify;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBrandData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $slugify = new Slugify();
        for ($i = 0; $i <= 10; $i++) {
            $sampleBrand = new Brand();
            $name = "Brand_" . $i;
            $sampleBrand->setName($name)->setSlugUrl($slugify->slugify($name));
            $manager->persist($sampleBrand);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }

}