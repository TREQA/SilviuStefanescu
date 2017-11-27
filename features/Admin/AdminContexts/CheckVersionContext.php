<?php
/**
 * Created by PhpStorm.
 * User: Dale Putley
 * Date: 10/20/2017
 * Time: 3:35 PM
 */

namespace AdminTests;

use Behat\Behat\Context\Context;
use AdminPages\EditOrderPage;
use Behat\MinkExtension\Context\RawMinkContext;
use UtilsPage\DataItems;
use UtilsPage\Utils;
use Webmozart\Assert\Assert;

class checkVersionContext extends RawMinkContext implements Context
{

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    private $utils;
    private $editOrderPage;

    public function __construct(EditOrderPage $editOrderPage, Utils $utils)
    {
        $this->utils = $utils;
        $this->editOrderPage = $editOrderPage;
    }

    /**
     * @Then /^I will be logged in and will see version number$/
     */
    public function iWillBeLoggedInAndWillSeeVersionNumber1()
    {
        //check if there is an "Incoming Message" popup covering the content. If yes, I close the popup
        $hasmodal=$this->getSession()->getPage();
        if ($hasmodal->find('xpath', '//BUTTON[@class="action-close"]'))
        {
            $this->getSession()->getPage()->find('xpath','//BUTTON[@class="action-close"]')->click();
        }
        //get the version text
        $versionText = $this->getSession()->getPage()->find('xpath', '//DIV[@class="col-m-12 text-right"]')->getText();
        //echo "VERSION: ".$versionText;
        //regex validation
        $regexValidation=preg_match('/(app ver. )\d[.]\d[.]\d/', $versionText);
        echo "REGEX:".$regexValidation;
        expect($regexValidation)->shouldBe(1);
    }
}
//P[@class="magento-version"][text()="app ver. 2.0.0"]
//P[@class='magento-version'][text()='app ver. 2.0.0']