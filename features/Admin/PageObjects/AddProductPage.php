<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 16.05.2017
 * Time: 15:41
 */

namespace AdminPages;


use UtilsPage\DataItems;
use UtilsPage\Utils;

class AddProductPage extends Utils
{

    public function getMyCart(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='action showcart']/span[1]");
    }

    public function getUnitPriceLabel (){
        return $this->find("xpath","//*[contains(text(),'Unit Price')]");
    }

    public function getProdInWebsite(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[contains(text(),'Product in Websites')]");
    }

    public function getMainWebSiteCheckbox(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@name='product[website_ids][1]']");
    }

    public function getProductNameField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@name='product[name]']");
    }

    public function getProductSkuField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@name='product[sku]']");
    }

    public function getProductPriceField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@name='product[price]']");
    }

    public function setAttrSet($attrSet){
        return $this->setSearchField(
            "xpath",
            "//*[@id=\"container\"]/div/div[2]/div[1]/div/fieldset/div[2]/div/div/div[1]/div",
            "//*[@id=\"container\"]/div/div[2]/div[1]/div/fieldset/div[2]/div/div/div[2]/div/input",
            "//*[@id=\"container\"]/div/div[2]/div[1]/div/fieldset/div[2]/div/div/div[2]/ul/li",
            $attrSet
            );
    }

    public function getDropShipVendorField(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@name='product[udropship_vendor]']");
    }

    public function getSaveButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='save-button']");
    }

    public function getPageMessage(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='messages']/div/div");
    }

    public function getProductCategory(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"css","#container > div > div.entry-edit.form-inline > div:nth-child(1) > div > fieldset > fieldset:nth-child(10) > div > div:nth-child(1) > div > div > div.action-select.admin__action-multiselect");
    }
                                                                                             #container > div > div.entry-edit.form-inline > div:nth-child(1) > div > fieldset > fieldset:nth-child(10) > div > div:nth-child(1) > div > div > div.action-select.admin__action-multiselect
    #M0Q67FR > div.action-select.admin__action-multiselect

    public function getEnableProductSwitchClickable(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='admin__actions-switch-label']");
    }

    public function getEnableProductSwitchValue(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='admin__actions-switch-checkbox']");
    }

    public function getContentSection(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"container\"]//*[text()='Content']");
    }

    public function getProdAttributesSelect(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@name=\"product[ac_device_type]\"]");
    }

    public function getProdSolutionsSelect(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@name=\"product[ac_vertical]\"]");
    }

    public function addProdCategory($category){
        $this->getProductCategory()->click();

    }

    //adv price
    public function getAdvancedPricingBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-index='advanced_pricing_button']");
    }

    public function getAdvPriceField($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@name='product[tier_price][".($row-1)."][price]']");
    }

    public function getAdvPriceQtyField($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@name='product[tier_price][".($row-1)."][price_qty]']");
    }

    public function getAdvPriceDoneBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","
        //*[@class='modal-slide undefined product_form_product_form_advanced_pricing_modal             _show']//*[@class='action-primary']
        ");
    }

    public function getOverlay(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='modals-overlay']");
    }
}
