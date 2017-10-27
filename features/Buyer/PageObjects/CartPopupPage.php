<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 10-May-17
 * Time: 2:18 PM
 */

namespace BuyerPages;

use UtilsPage\DataItems;
use UtilsPage\Utils;

class CartPopupPage extends Utils
{

    public function getMyCart(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='action showcart']/span[1]");
    }

    public function getEmptyCart(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='subtitle empty']/span");
    }

    public function getItemsNo(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='items-total']/span[1]");
    }

    public function getSubtotalTitle(){
        return $this->findElement("xpath","//*[@class='subtotal']/span/span");
    }

    public function getSubtotalValue(){
        return $this->findElement("xpath","//*[@class='price-wrapper']/span");
    }

    public function getCheckoutButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='top-cart-btn-checkout']");
    }

    public function getEditButton(){
        return $this->findElement("xpath","//*[@class='action edit']");
    }

    public function getDeleteButton(){
        return $this->findElement("xpath","//*[@class='action delete']");
    }

    public function getViewCartButton(){
        return $this->findElement("xpath","//*[@class='action viewcart']");
    }

    //Buyer empty cart
    public function emptyCart(){
        $empty = true;
        $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='action showcart']/span[1]")->click();
        sleep(2);
        do{
            $items = $this->find('xpath','//*[@class=\'count\']');
            if($items!=null){
                $this->waitUntilElementPresent(DataItems::waitTime,'xpath','//*[@class=\'action delete\']')->click();
                $this->waitUntilElementPresent(DataItems::waitTime,'xpath','//*[@class=\'action-primary action-accept\']/span')->click();
                sleep(3);
            }else{
                $empty = false;
            }
        }
        while ($empty);
    }
}