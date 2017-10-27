<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/9/2017
 * Time: 10:12 AM
 */

namespace BuyerPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class CardPaymentPage extends Utils
{

    public function getCardCb(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='cardTypeCb']");
    }

    public function getCardVisa(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='cardTypeVisa']");
    }

    public function getCardMaster(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='MASTERCARD']");
    }

    public function getCardMaestro(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='MAESTRO']");
    }

    public function getCardNoField(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='tokenCardNumber']");
    }

    public function getCardHolderField(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='tokenCardHolder']");
    }

    public function getExpDateMonthDropdown(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='tokenCardExpiryDateMonth']");
    }

    public function getExpDateYearDropdown(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='tokenCardExpiryDateYear']");
    }

    public function getCvvField(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='tokenCardSecurityCode']");
    }

    public function getPayBtn(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='validate_user_account_create_form']");
    }

    public function getProcessPayMsg(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id=\"loader\"]/h3");
    }

    public function getPaySuccessMsg(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='endSuccessTransactionBlock']");
    }
}