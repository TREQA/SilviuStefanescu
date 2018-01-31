<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 11-May-17
 * Time: 3:37 PM
 */

namespace BuyerPages;


use UtilsPage\DataItems;
use UtilsPage\Utils;

class LoginPage extends Utils
{
    public function getTitle(){
        return $this->findElement("xpath","//*[@class='page-title']/span");
    }

    public function getRegCustomerCanAccPopup(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[contains(text(),'Only registered customers can access this content.')]");
    }

    public function getCheckoutPopupTitle(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[contains(text(),'Checkout out using your account')]");
    }

    public function getCheckoutNewPopupTitle(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id='block-new-customer-heading']");
    }

    public function getCreateAccButton(){
        return $this->findElement("xpath","//*[@class='action create primary']");
    }

    public function getCreateAccButtonPopUp(){
        return $this->findElement("xpath","//*[@class='action action-register primary']");
    }

    public function getEmailField(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='email']");
    }

    public function getPasswordField(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id='pass']");
    }

    public function getSignInButton(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id='send2']");
    }

    public function getInvalidLoginMsg(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@class='message-error error message']");
    }

    public function getForgotPasswordButton(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@class='action remind']/span");
    }


}