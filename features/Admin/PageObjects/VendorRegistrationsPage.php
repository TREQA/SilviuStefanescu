<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/16/2017
 * Time: 3:55 PM
 */

namespace AdminPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class VendorRegistrationsPage extends Utils
{
    public function getVendorEmailField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='registrationGrid_reg_filter_email']");
    }

    public function getVendorEmail($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"registrationGrid_table\"]/tbody/tr[".$row."]/td[4]");
    }

    public function getSearchBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"registrationGrid\"]/div[1]/div[1]/div[1]/button[1]");
    }

    public function waitForLoad(){
        $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"loading-mask\"]");
        return $this->waitUntilElementInvisible(DataItems::waitTime,"xpath","//*[@class=\"loading-mask\"]");
    }
}