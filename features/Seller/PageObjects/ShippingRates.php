<?php
/**
 * Created by PhpStorm.
 * User: bmurguly
 * Date: 8/17/2017
 * Time: 3:35 PM
 */

namespace SellerPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class ShippingRates extends Utils
{
    public function getDeliveryTypeBtn(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"tiership_delivery_type_selector\"]");
    }

    public function getContAndRegField(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"continents-select-1 continents-multi\"]");
    }

    public function getAddRateBtn(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"addBtntiership_v2_simple_cond_rates\"]");
    }
    public function getAddBtn(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"scalable add addCountries-1 customButton\"]");
    }

    public function getRemoveBtn(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"scalable add removeCountries-1 customButton\"]");
    }

    public function getSelectedCountriesField(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"final-select-1\"]");
    }

    public function getSelectedCountriesAllOptions(){
        return $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","//*[@class=\"final-select-1\"]/option");
    }

    public function findSelectedCountriesAllOptions(){
        return $this->find("xpath","//*[@class=\"final-select-1\"]/option");
    }

    public function getConditionName(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@name=\"tiership_v2_simple_cond_rates[1][1][condition_name]\"]");
    }

    public function getAddConditionBtn(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"addBtntiership_v2_simple_cond_rates_1__1__condition_\"]");
    }

    public function get1st1stConditionDelete(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"cfgTabletiership_v2_simple_cond_rates_1__1__condition_\"]/tbody/tr[1]/td[4]/button");
    }

    public function get1st2ndIfConditionUpTo(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@name=\"tiership_v2_simple_cond_rates[1][1][condition][2][condition_to]\"]");
    }

    public function get1st2ndConditionPrice(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@name=\"tiership_v2_simple_cond_rates[1][1][condition][2][price]\"]");
    }

    public function getSaveBtn(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"btn btn-primary form-button\"]");
    }

    public function getSuccessMessage(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"message message-success success\"]");
    }

    public function checkSelectedCountries($expectedCountries)
    {
        $selectedCountries = $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","//*[@class=\"final-select-1\"]/option");

        $lengthCountries = count($selectedCountries);

        for ($i=0 ; $i < $lengthCountries; $i++){
            $countryName = $selectedCountries[$i]->getText();

            expect($countryName) -> shouldBe($expectedCountries[$i]);
        }
    }
}