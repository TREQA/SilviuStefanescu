<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 12.05.2017
 * Time: 17:37
 */

namespace BuyerPages;


use UtilsPage\DataItems;
use UtilsPage\Utils;

class RecoverPasswordPage extends Utils
{
    public function     getPageMessage(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='field note']");
    }

    public function getEmailField(){
        return $this->findElement("xpath","//*[@id='email_address']");
    }

    public function getCaptchaField(){
        return $this->findElement("xpath","//*[@id='captchaAnswer']");
    }

    public function getCancelButton(){
        return $this->findElement("xpath","//*[@id='cancelReset']");
    }

}