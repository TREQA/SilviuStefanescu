<?php
/**
 * Created by PhpStorm.
 * User: Dale Putley
 * Date: 10/26/2017
 * Time: 3:25 PM
 */
namespace BuyerTests;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use BuyerPages\HomePage;

class AnonCompareContext extends RawMinkContext implements Context {

    private $homePage;
    public function __construct(
        HomePage $homePage
    )
    {
        $this->homePage=$homePage;
    }

    /**
     * @Given /^I click on Devices$/
     */
    public function iClickOnDevices()
    {
        $this->homePage->getDevicesMenuOption()->click();
    }

    /**
     * @Given /^I click on product Add to Compare icon$/
     */
    public function iClickOnProductAddToCompareIcon()
    {
        $this->homePage->getAddToCompareButton()->click();
    }

    /**
     * @Then /^The confirmation message will be shown\.$/
     */
    public function theConfirmationMessageWillBeShown()
    {
        $confirmation_message=$this->homePage->getAddToCompareConfirmation()->getText();
        $confirmation_message=substr($confirmation_message, 0, 16);
        $should_be="You added product";
        expect($confirmation_message)->shouldBe($confirmation_message);
    }
}