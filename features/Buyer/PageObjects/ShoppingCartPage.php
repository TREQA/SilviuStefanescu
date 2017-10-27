<?php
/**
 * Created by PhpStorm.
 * User: gabriel.curdov
 * Date: 19.05.2017
 * Time: 13:38
 */

namespace BuyerPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class ShoppingCartPage extends Utils
{
    public function getProceedToCheckoutBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@title='Proceed to Checkout']");
    }

    public function getOrderTotal(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='grand totals']/td/strong/span");
    }
}