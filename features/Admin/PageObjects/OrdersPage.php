<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/9/2017
 * Time: 5:19 PM
 */

namespace AdminPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class OrdersPage extends Utils
{

    public static $commonListPath = " //*[@id=\"container\"]/div/div[4]/table/tbody";

    public function getFilterBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"css","#container > div > div.admin__data-grid-header > div:nth-child(1) > div.data-grid-filters-actions-wrap > div > button");
    }

    public function getSearchField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"container\"]/div/div[2]/div[1]/div[2]/input");
    }

    public function getSearchBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"container\"]/div/div[2]/div[1]/div[2]/button");
    }

    public function getIdFilter(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='admin__control-text' and @name = 'increment_id']");

    }

    public function getApplyFilterBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-action='grid-filter-apply']");
    }

    public function getViewBtn($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::$commonListPath."/tr[".$row."]/td[10]/a");
    }

    public function getOrderID(){

    }
}