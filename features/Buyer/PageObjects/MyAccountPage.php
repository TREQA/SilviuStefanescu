<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 11-May-17
 * Time: 2:45 PM
 */

namespace BuyerPages;

use UtilsPage\DataItems;
use UtilsPage\Utils;

class MyAccountPage extends Utils
{

    /**
     * Dashboard menu
     **/
    public function getPageMessage(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='messages']/div/div");
    }

    /*public function getTitle(){
        return $this->findElement("xpath","//*[contains(text(),'My Dashboard')]");
    }*/

    public function getTitle(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='page-title']/span");
    }

    public function getAccountInfo(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"maincontent\"]/div[2]/div[1]/div[3]/div[2]/div[1]/div[1]/p");
    }

    public function getOrderMessagesMenu(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"block-collapsible-nav\"]/ul/li[11]/a");
    }

    public function getEditAccInfoButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='action edit']/span");
    }

    /**
     * Account Information menu
     **/
    public function getChPassBox(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='change-password']");
    }

    public function getChEmailBox(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='change-email']");
    }

    public function getFirstNameField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='firstname']");
    }

    public function getSecondNameField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='lastname']");
    }

    public function getTaxVatField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='taxvat']");
    }

    public function getEmailField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='email']");
    }

    public function getCurrentPassField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='current-password']");
    }

    public function getNewPassField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='password']");
    }

    public function getConfNewPassField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='password-confirmation']");
    }

    public function getSaveButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='action save primary']/span");
    }

    /**
     * Account Dashboard menu
     **/

    public function getFirstViewInvoice(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"my-orders-table\"]/tbody/tr[1]/td[6]/a[2]");
    }

}