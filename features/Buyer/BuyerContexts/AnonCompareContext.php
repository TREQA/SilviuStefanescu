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
    //$itemname will store item name returned by one method to be used by another method
    private $itemName='';

    public function __construct(
        HomePage $homePage
    )
    {
        $this->homePage=$homePage;
    }

    /**
     * @When /^I click on "([^"]*)" page$/  
     */
    public function iClickOnPage($productpage)
    {
      
        //pt debug
        echo "PRODUS:".$productpage;
     
        switch ($productpage) {
            case "Devices":
                $this->homePage->getDevicesMenuOption()->click();
                break;
            case "Gateways":
                $this->homePage->getGatewaysMenuOption()->click();
                break;
            case "ThingPark":
                $this->homePage->getThingParkConnectedMenuOption()->click();
                break;
        }
    }

    /**
     * @Given /^I click on products Add to Compare icon$/
     */
    public function iClickOnProductsAddToCompareIcon()
    {
        //$results_array = $this->homePage->getProductNameAndAddToCompareButton();
        //$results_array[0]->click();
         $this->itemName=$this->homePage->getProductNameAndAddToCompare();
    }

    /**
     * @Then /^The confirmation message will be shown\.$/
     */
    public function theConfirmationMessageWillBeShown()
    {
        $confirmation_message=$this->homePage->getAddToCompareConfirmation()->getText();
        $should_be="You added product ".$this->itemName." to the comparison list.";
        expect(strtoupper($confirmation_message))->shouldBe(strtoupper($should_be));
    }

    /**
     * @Given /^Compare Products link with counter is updated$/
     */
    public function compareProductsLinkWithCounterIsUpdated()
    {
        $compareProductsLink=$this->homePage->getCompareProductsQuantity()->getText();
        //echo "Compare products link: ".$compareProductsLink;
        expect($compareProductsLink)->shouldNotBe('');
    }
}