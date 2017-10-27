<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 23.05.2017
 * Time: 08:51
 */

namespace SellerPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class HomePage extends Utils
{
    public function getProductManagerMenu(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"nav-product-manager\"]");
    }

    public function getStockMenu(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"nav-stock\"]");
    }

    public function getOrdersMenu(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"nav-orders active\"]");
    }

    public function getSystemViewMenu(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"nav-system-view\"]");
    }

    public function getShippingRatesMenu(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"nav-shipping-rates\"]");
    }
}