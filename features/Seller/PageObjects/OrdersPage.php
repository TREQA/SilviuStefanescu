<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/12/2017
 * Time: 3:43 PM
 */

namespace SellerPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class OrdersPage extends Utils
{
    const commonPath = "//*[@id=\"udpo-grid\"]/tbody";

    public function getSuccMsg(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id='messages-message-success']");
    }

    public function getOrderStatus($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::commonPath."/tr[".$row."]/td[7]");
    }

    public function getOrderCollapseMenu($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::commonPath."/tr[".$row."]/td[1]");
    }

    public function getBuyerQuestionTitle(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::commonPath."/tr[2]/td/form[2]/div/div[1]");
    }

    public function getBuyerQuestionLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::commonPath."/tr[2]/td/form[2]/div/div[2]/div/div[1]/label");
    }

    public function getBuyerQuestionField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@name = 'buyer_question']");
    }

    public function getBuyerQuestionBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime, "xpath", self::commonPath . "/tr[2]/td/form[2]/div/div[2]/div/div[2]/button");
    }

    public function getFirstOrder(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id='udpo-grid']/tbody/tr[1]//*[@class='action']");
    }

    public function getBrowseFile(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='fileupload']");
    }

    public function getFirstOrderOrderID(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"row-169\"]/td[3]");
    }

    public function getAttachedPdfName(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"file-info-169\"]");
    }
}