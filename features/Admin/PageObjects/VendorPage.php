<?php
/**
 * Created by PhpStorm.
 * User: gabriel.curdov
 * Date: 19.05.2017
 * Time: 16:21
 */

namespace AdminPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class VendorPage extends Utils
{
    public function getMessage(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='messages']");
    }

    public function getVendorMessage(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id='messages-message-success']");
    }

    public function getAddVendorBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='add']");
    }

    public function getVendorName($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendorGrid_table\"]/tbody/tr[".$row."]/td[3]");

    }

    public function getVendorEmail($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendorGrid_table\"]/tbody/tr[".$row."]/td[4]");
    }

    public function getVendorUsedCarr($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendorGrid_table\"]/tbody/tr[".$row."]/td[5]");
    }

    public function getViewButton($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendorGrid_table\"]/tbody/tr[".$row."]/td[9]/a");
    }

    public function editVendor($vendorEmail){
        $vendors = $this->getSession()->getPage()->findAll("xpath","//*[@id=\"vendorGrid_table\"]/tbody/tr");
        echo "number of vendors ".count($vendors)."\r\n";

        for($i=1;$i<=count($vendors);$i++){
            $vendorMail = $this->getVendorEmail($i)->getText();
            echo "expected: ".$vendorEmail."\r\n";
            echo "found   : ".$vendorMail."\r\n";
            if($vendorEmail == $vendorMail){
                echo"found it!";
                return $this->getViewButton($i)->click();
            }else{
                throw new \RuntimeException(sprintf('Could not find vendor '.$vendorMail));
            }
        }
    }

    public function getVendorEmailField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='vendorGrid_vendor_filter_email']");
    }

    public function getSearchBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendorGrid\"]/div[1]/div[1]/div[1]/button[1]");
    }

    public function waitForLoad(){
        $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='loading-mask']");
        $this->waitUntilElementInvisible(DataItems::waitTime,"xpath","//*[@class='loading-mask']");
    }

}