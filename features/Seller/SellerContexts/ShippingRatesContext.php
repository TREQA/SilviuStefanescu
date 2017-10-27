<?php
/**
 * Created by PhpStorm.
 * User: bmurguly
 * Date: 8/17/2017
 * Time: 3:25 PM
 */

namespace SellerTests;


use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use SellerPages\HomePage;
use SellerPages\SellerValues;
use SellerPages\ShippingRates;
use UtilsPage\DataItems;
use UtilsPage\Utils;


class ShippingRatesContext extends RawMinkContext implements Context
{
    
    private $utils;
    private $homePage;
    private $shippingRates;
    
    public function __construct(HomePage $homePage,ShippingRates $shippingRates, Utils $utils)
    {
        $this->homePage = $homePage;
        $this->shippingRates = $shippingRates;
        $this->utils = $utils;
    }

    /**
     * @Given /^I go to Shipping Rates$/
     */
    public function iGoToShippingRates()
    {
        $this->homePage->getShippingRatesMenu()->click();
    }

    /**
     * @Then /^I select Standard Shipping$/
     */
    public function iSelectStandardShipping()
    {
        $this->shippingRates->getDeliveryTypeBtn()->selectOption("Standard shipping");
    }

    /**
     * @Given /^I click on "([^"]*)" from Continents and Regions$/
     */
    public function iClickOnFromContinentsAndRegions($arg1)
    {
        $this->shippingRates->getContAndRegField()->selectOption($arg1);
    }

    /**
     * @Then /^I click on ADD button$/
     */
    public function iClickOnADDButton()
    {
        $this->shippingRates->getAddBtn()->click();
    }

    /**
     * @Given /^I select all countries from Selected Countries$/
     */
    public function iSelectAllCountriesFromSelectedCountries()
    {
       $script = "jQuery('.final-select-1').click(function() {
                    jQuery('.final-select-1 option').prop('selected', true);
                  });";
       $this->getSession()->evaluateScript($script);
       $this->shippingRates->getSelectedCountriesField()->click();
    }

    /**
     * @Then /^I click on Remove Button$/
     */
    public function iClickOnRemoveButton()
    {
        $this->shippingRates->getRemoveBtn()->click();
    }

    /**
     * @Given /^I select "([^"]*)" condition name$/
     */
    public function iSelectConditionName($arg1)
    {
        $this->shippingRates->getConditionName()->selectOption($arg1);
    }

    /**
     * @Then /^I click on Add Condition$/
     */
    public function iClickOnAddCondition()
    {
        $this->shippingRates->getAddConditionBtn()->click();
    }

    /**
     * @Given /^I complete all the fields for condition$/
     */
    public function iCompleteAllTheFieldsForCondition()
    {
        $this->shippingRates->get1st2ndIfConditionUpTo()->setValue("10");
        $this->shippingRates->get1st2ndConditionPrice()->setValue("10");
        $this->shippingRates->get1st1stConditionDelete()->click();
    }

    /**
     * @Given /^I save shipping rates$/
     */
    public function iSaveShippingRates()
    {
        $this->shippingRates->getSaveBtn()->click();
    }

    /**
     * @Then /^a confirmation message appears regarding rates$/
     */
    public function aConfirmationMessageAppearsRegardingRates()
    {
        $sucMsg = $this->shippingRates->getSuccessMessage()->getText();
        expect($sucMsg) -> shouldBe(SellerValues::rateSaveSucMsg);
    }

    /**
     * @Then /^Selected Countries field is "\*\*\* All \*\*\*"$/
     */
    public function selectedCountriesFieldIs()
    {
        if (is_null($this->shippingRates->findSelectedCountriesAllOptions())){

            throw new \RuntimeException(sprintf("Selected Countries list is empty"));

        } else {

            $optionList = $this->shippingRates->getSelectedCountriesAllOptions()->getText();
            expect($optionList) -> shouldBe(SellerValues::allCountries);
        }
    }

    /**
     * @Then /^I select Express Shipping$/
     */
    public function iSelectExpressShipping()
    {
        $this->shippingRates->getDeliveryTypeBtn()->selectOption("Express shipping");
    }

    /**
     * @Then /^"([^"]*)" Countries are present in Selected Countries$/
     */
    public function countriesArePresentInSelectedCountries($region)
    {
        $prefixRegion = lcfirst(str_replace(" ","", $region));
        $list = "{$prefixRegion}Countries";

        $r = new \ReflectionClass('\SellerPages\SellerValues');
        $id = $r->getConstant($list);


        $this->shippingRates->checkSelectedCountries($id);
    }

    /**
     * @Given /^I click on Add Rate button$/
     */
    public function iClickOnAddRateButton()
    {
        $this->shippingRates->getAddRateBtn()->click();
    }
    
}