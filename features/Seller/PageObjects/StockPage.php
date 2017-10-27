<?php


namespace SellerPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class StockPage extends Utils
{
    public function getFilterButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"filter-orders-toggle\"]");
    }

    public function getProdNameFilter(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"filter-name\"]");
    }

    public function getSearchBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"filter-search\"]");
    }

    public function getProdStatusDropdown($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendor-stock-form\"]/div[2]/table/tbody/tr[".$row."]/td[5]/select");
    }

    public function getCurrentProdStatus($row){
        return $this->getSelectedOption("xpath","//*[@id=\"vendor-stock-form\"]/table/tbody/tr[".$row."]/td[5]/select");
    }

    public function getProdQty($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendor-stock-form\"]/div[2]/table/tbody/tr[".$row."]/td[6]/input");
    }

    public function getUpdateInfBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[contains(text(),'Update Information')]");
    }
}