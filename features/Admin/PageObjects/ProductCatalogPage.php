<?php

namespace AdminPages;

use UtilsPage\Utils;
use UtilsPage\DataItems;

/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 16.05.2017
 * Time: 15:32
 */
class ProductCatalogPage extends Utils
{
    public function checkProductTypeLabel($addProductTypes){

        $options = $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product\"]/ul/li");
        echo count($options);
        for ($i=0 ; $i < count($options) ; $i++ ){
            $buttonLabel = $options[$i]->getText();
            echo "   Found: " . $buttonLabel . "\r\n";
            echo "Expected: " . $addProductTypes[$i] . "\r\n";
            if ($buttonLabel === $addProductTypes[$i]){
                echo "Match " . "\r\n";
            }   else {
                throw new \RuntimeException(sprintf('Missmatch'));
            }
        }
    }

    public function getAddProdOptionsButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='add_new_product']/button[2]");
    }

    public function getProdNoPriceButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product\"]/ul/li[3]/span");
    }

    public function getSimpleProduct(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product\"]/ul/li[1]/span");
    }

    public function getConfigurableProduct(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product\"]/ul/li[2]/span");
    }

    public function getPartner(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product\"]/ul/li[4]/span");
    }

    public function getQuote(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product\"]/ul/li[5]/span");
    }

    public function getGroupedProduct(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product\"]/ul/li[6]/span");
    }

    public function getVirtualProduct(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product\"]/ul/li[7]/span" );
    }

    public function getBundleProduct(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product\"]/ul/li[8]/span");
    }

    public function getDownloadableProduct(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product\"]/ul/li[9]/span");
    }

    public function getProdName($row,$productName){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"container\"]/div/div[4]/table/tbody/tr[".$row."]/td[4]/div[contains(text(),'".$productName."')]");
    }

    public function getProdPrice($row){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"container\"]/div/div[4]/table/tbody/tr[".$row."]/td[8]");
    }

    public function getProdStatus($row,$prodName){
        $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"container\"]/div/div[4]/table/tbody/tr[".$row."]/td[4]/div[contains(text(),'".$prodName."')]");
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"container\"]/div/div[4]/table/tbody/tr[".$row."]/td[12]/div");
    }

    public function getAddProdDefault(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='add_new_product-button']");
    }

    public function getFilterBtn(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"css","#container > div > div.admin__data-grid-header > div:nth-child(1) > div.data-grid-filters-actions-wrap > div > button");
    }

    public function getNameFilterField(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='admin__control-text' and @name = 'name']");

    }

    public function getApplyFilterBtn(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@data-action='grid-filter-apply']");
    }

    public function getAttributeSetFilterBtn(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='admin__control-select' and @name='attribute_set_id']");
    }

    public function getProductRow($row){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"container\"]/div/div[4]/table/tbody/tr[".$row."]");
    }
}