<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 11-May-17
 * Time: 2:17 PM
 */

namespace BuyerPages;

use UtilsPage\DataItems;
use UtilsPage\Utils;

class ProductDetailsPage extends Utils
{

    public function getProductName(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@itemprop='name']");
    }

    public function getAddToCartButton(){
        return $this->findElement("xpath","//*[@id='product-addtocart-button']/span");
    }

    public function getPrice(){
        return $this->findElement("xpath","//*[@class='price-wrapper ']/span");
    }

    public function getFavoriteButton(){
        return $this->findElement("xpath","//*[@class='bt-wishlist']");
    }

    public function getPDFTableTitle(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"product-attribute-specs-table\"]/tbody/tr[14]/th");
    }
    public function getFirstPDFlink(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@data-th=\"Technical docs\"]/a");
    }

    //elements return null if not found
    public function getAddToCartButtonNot(){
        return $this->find("xpath","//*[@id='product-addtocart-button']/span");
    }

    public function getPriceNot(){
        return $this->find("xpath","//*[@class='price-wrapper ']/span");
    }

    public function getOutOfStockLabelNot(){
        return $this->find("xpath","//*[@class='stock unavailable']/span");
    }

    public function getVatExcludedNot(){
        return $this->find("xpath","//*[@class='price-display-vat']");
    }

    public function getNotifPriceDropNot(){
        return $this->find("xpath","//*[@class='product alert price']/a");
    }

    public function getNotifStockNot(){
        return $this->find("xpath","//*[@class='product alert stock']/a");
    }

    //adv pricing
    public function getOldPriceOffer(){
        return $this->find("xpath","//*[@class='old-price']");
    }

    public function getSpecialPriceOffer(){
        return $this->find("xpath","//*[@data-price-type='finalPrice']");
    }

    public function getAdvancedPricingOffer($row){
        return $this->find("xpath","//*[@class='prices-tier items']/li[".$row."]");
    }

}