<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 11-May-17
 * Time: 2:52 PM
 */

namespace BuyerPages;


use UtilsPage\DataItems;
use UtilsPage\Utils;

class CreateNewAccPage extends Utils
{
    public function getTitle(){
        return $this->findElement("xpath","//*[@class='page-title']/span");
    }

    public function getFirstNameField(){
        return $this->findElement("xpath","//*[@id='firstname']");
    }

    public function getLastNameField(){
        return $this->findElement("xpath","//*[@id='lastname']");
    }

    public function getNewsLetterBox(){
        return $this->findElement("xpath","//*[@id='is_subscribed']");
    }

    public function getTaxtVatField(){
        return $this->findElement("xpath","//*[@id='taxvat']");
    }

    public function getEmailField(){
        return $this->findElement("xpath","//*[@id='email_address']");
    }

    public function getPasswordField(){
        return $this->findElement("xpath","//*[@id='password']");
    }

    public function getConfirmPassField(){
        return $this->findElement("xpath","//*[@id='password-confirmation']");
    }

    public function getRememberMeBox(){
        return $this->findElement("xpath","//*[@id='remember-me-box']/input");
    }

    public function getCreateAccButton(){
        return $this->findElement("xpath","//*[@title='Create an Account']/span");
    }

}