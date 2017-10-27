<?php

namespace AdminPages;

use UtilsPage\Utils;
use UtilsPage\DataItems;

/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 16.05.2017
 * Time: 15:31
 */
class HomePage extends Utils
{
    /**
     * Product Menu
     */
    public function getProductMenu(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"menu-magento-catalog-catalog\"]/a");
    }

    public function getCatalogMenu(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"item-catalog-products    level-2\"]/a");
    }


    /**
     * Sales Menu
     */
    public function getSalesMenu(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"menu-magento-sales-sales\"]/a");
    }

    public function getOrdersMenu(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id=\"menu-magento-sales-sales-order\"]/a");
    }

    public function getVendorMenu(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id=\"menu-unirgy-dropship-vendor\"]/a");
    }

    public function getVendorRegistrationsMenu(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id=\"menu-unirgy-dropshipmicrosite-registration\"]/a");
    }

    public function getOrderCommunicationsMenu(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id=\"menu-actility-vendorcustomercommunication-all-comm\"]/a");
    }

    public function waitForLoad(){
        $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"admin__form-loading-mask\"]");
        return $this->waitUntilElementInvisible(DataItems::waitTime,"xpath","//*[@class=\"admin__form-loading-mask\"]");
    }

    public function waitForLoadData(){
        $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"admin__data-grid-loading-mask\"]");
        return $this->waitUntilElementInvisible(DataItems::waitTime,"xpath","//*[@class=\"admin__data-grid-loading-mask\"]");
    }

    public function waitForJQuery(){
        $this->getSession()->wait(5000,'(0 === jQuery.active)');
    }
}