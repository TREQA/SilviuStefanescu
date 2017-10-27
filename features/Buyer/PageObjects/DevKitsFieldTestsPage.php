<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 12.05.2017
 * Time: 18:57
 */

namespace BuyerPages;


use UtilsPage\DataItems;
use UtilsPage\Utils;

class DevKitsFieldTestsPage extends Utils
{
    public function getFirstAddCartButton(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id=\"maincontent\"]/div[4]/div[1]/div[3]/ol/li[1]/div/div[2]/div[2]/div/form/button");
    }

    public function getFirstProductName(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id=\"maincontent\"]/div[4]/div[1]/div[3]/ol/li[1]/div/div[2]/strong/a");
    }

    public function getFirstProductPrice(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@id=\"maincontent\"]/div[4]/div[1]/div[3]/ol/li[1]//*[@class='price-wrapper ']");
    }

}