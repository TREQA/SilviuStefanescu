<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/8/2017
 * Time: 6:54 PM
 */

namespace BuyerPages;



use UtilsPage\Utils;
use UtilsPage\DataItems;

class CheckoutPage extends Utils
{

    public function getNextButton(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@class='button action continue primary']");
    }

    public function getCreditCardRadioBtn(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='hipay_direct']");
    }

    public function getBankTransferRadioBtn(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='banktransfer']");
    }

    public function getSellerTcCheckBox(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@class='choice field actility_aggrement']/input");
    }

    public function getBillAgreeCheckBox(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='hipay_direct_create_ba']");
    }

    public function getThinkParkTcHiPayCheckBox(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id=\"checkout-payment-method-load\"]/div/div/div[3]/div[2]/div[2]/div/div/div/input");
    }

    public function getThinkParkTcBankTransferCheckBox(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id=\"checkout-payment-method-load\"]/div/div/div[2]/div[2]/div[3]/div/div/div/input");
    }

    public function getPayPlaceOrdBtn($text){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[contains(text(),'".$text."')]");
    }

    public function getPaySucessMsg(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[contains(text(),'Order\'s payment is pending capture')]");
    }

    public function getOrderPlacedEmailMsg(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id=\"maincontent\"]/div[3]/div/div[2]/p[2]");
    }

    public function getOrderID(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@class=\"order-number\"]");
    }

    public function waitForLoad(){
        $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@class=\"loading-mask\"]");
        $this->waitUntilElementInvisible(DataItems::waitTime,"xpath","//*[@class=\"loading-mask\"]");
    }
}