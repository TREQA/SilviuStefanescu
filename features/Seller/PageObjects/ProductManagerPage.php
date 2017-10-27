<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 23.05.2017
 * Time: 09:32
 */

namespace SellerPages;


use Braintree\Util;
use UtilsPage\Utils;
use UtilsPage\DataItems;

class ProductManagerPage extends Utils
{
    private static $commonTablepath = "//*[@class='data-table']/tbody/tr[";
    
    public function getProductTypeDropdown(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"type_of_product\"]");
    }

    public function getSecProductTypeDropdown(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"udprod_set_id\"]");
    }

    public function getAddNewProdButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product_simple\"]");
    }

    public function getAddNewProdNoPriceButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"add_new_product_display\"]");
    }

    public function getMsg(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"messages\"]");
    }

    public function getProdNameLink($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::$commonTablepath.$row."]/td[4]/a");
    }

    public function getProdSystemStatus($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::$commonTablepath.$row."]/td[6]");
    }

    public function getProdStkStatus($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::$commonTablepath.$row."]/td[7]");
    }

    public function getProdStkQty($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::$commonTablepath.$row."]/td[8]");
    }

    public function getDeleteBtn($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::$commonTablepath.$row."]/td[9]/a");
    }

    public function getProdDisableEnableBtn($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::$commonTablepath.$row."]/td[10]");
    }

    public function getProdFilter(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"filter-orders-toggle\"]");
    }

    public function getProdNameFilter(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"filter-name\"]");
    }

    public function getSearchButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"filter-search\"]");
    }


    
    /**
     * These items return null if not found
     */
    
    public function getNotDisableEnableBtn($row){
        $this->getSession()->getPage()->find("xpath",self::$commonTablepath.$row.$row."]/td[10]");
    }

    public function getNotProdNameLink($row){
        $this->getSession()->getPage()->find("xpath",self::$commonTablepath.$row."]/td[4]/a");
    }

    /**
     * End
     */
}