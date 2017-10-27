<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/12/2017
 * Time: 12:32 PM
 */

namespace AdminPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class EditOrderPage extends Utils
{

    public function getCreatePoBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"create_upo\"]");
    }

    public function getPoCreatedMsg(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"messages\"]");
    }

    public function getLoginError(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id=\"messages-message-error\"]");
    }
}