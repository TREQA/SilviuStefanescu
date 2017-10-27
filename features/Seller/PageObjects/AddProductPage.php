<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 23.05.2017
 * Time: 09:33
 */

namespace SellerPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class AddProductPage extends Utils
{
    public function getProdNameField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"name\"]");
    }

    public function getManufPartNoField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"ac_manufacturer_part_number\"]");
    }

    public function getProdDescriptionField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"tinymce\"]/p");
    }

    public function getUnitPriceField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"price\"]");
    }

    public function getWeightField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"weight\"]");
    }

    public function getRadioFreqBandDropdown(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"ac_band\"]");
    }

    public function getSelectedRadioFreqBand(){
        return $this->getSelectedOption("xpath","//*[@id=\"ac_band\"]");
    }

    public function getBatteryTypeDropdown(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"ac_charger_type\"]");
    }

    public function getSelectedBatteryType(){
        return $this->getSelectedOption("xpath","//*[@id=\"ac_charger_type\"]");
    }

    public function getProdInfSect(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"panel\"]//*[contains(text(),'Product identification')]");
    }

    public function getPriceSect(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"panel\"]//*[contains(text(),'Price')]");
    }

    public function getDimSect(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"panel\"]//*[contains(text(),'Dimension (without packaging)')]");
    }

    public function getAdditDataSect(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"panel\"]//*[contains(text(),'Additional Data')]");
    }

    public function getShipLeadTimeInfSect(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"panel\"]//*[contains(text(),'Shipping & Lead time information')]");
    }

    public function getProdAttrSelect(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='ac_device_type']");
    }

    public function getProdSolSelect(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='ac_vertical']");
    }

    public function getSeoSect(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"panel\"]//*[contains(text(),'SEO')]");
    }

    public function getTechDocsSect(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"panel\"]//*[contains(text(),'Technical documents')]");
    }

    public function getImgsSect(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"panel\"]//*[contains(text(),'Images')]");
    }

    public function getSaveButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@onclick=\"udprodEditFormSubmit(this, false)\"]");
    }

    public function getSaveAndContButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@onclick=\"udprodEditFormSubmit(this, true)\"]");
    }

    //adv pricing
    public function getAddPriceButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@title=\"Add Price\"]");
    }

    public function getAdvPriceQtyField($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='tier_price_row_".($row-1)."_qty']");
    }

    public function getAdvPriceField($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='tier_price_row_".($row-1)."_price']");
    }
}