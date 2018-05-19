<?php


class FeatureContext extends \Behat\MinkExtension\Context\MinkContext
{
    /**
     * @When I click :arg1 link
     */
    public function iClickLink($arg1)
    {
        $this->getSession()->getPage()->find("css", "ul li:nth-child(" . $arg1 . ") a")->click();
    }


}
