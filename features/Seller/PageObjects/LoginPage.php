<?php

/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 5/12/2017
 * Time: 2:28 PM
 */
namespace SellerPages;

use UtilsPage\Utils;
use UtilsPage\DataItems;

class LoginPage extends Utils
{
    public function getSuccessMsg(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id=\"messages-message-success\"]");
    }

    public function getRejectMsg(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@data-ui-id=\"messages-message-error\"]");
    }

    public function getPageTitle(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"udropship-login-wrapper-col1\"]/div/div");
    }

    public function getEmailField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"email\"]");
    }

    public function getPasswordField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"pass\"]");
    }

    public function getLoginButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"btn btn-primary btn-block\"]");
    }
    public function getRegisterNewButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"login-form\"]/div/div[3]/ul/li/a");
    }

    public function getInvalidCredMsg(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"messages\"]");
    }

}