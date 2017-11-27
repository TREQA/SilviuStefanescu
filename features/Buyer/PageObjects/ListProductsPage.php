<?php
/**
 * Created by PhpStorm.
 * User: gabriel.curdov
 * Date: 17.05.2017
 * Time: 16:13
 */

namespace BuyerPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class ListProductsPage extends Utils
{
    const commonPath = "//*[@id=\"maincontent\"]/div[3]/div[1]/div[2]/div/ol/li[1]";
    //Previous xPath: //*[@id="maincontent"]/div[3]/div[1]/div[2]/div[2]/ol/li[1]
    
    public function getFirstProduct(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath",self::commonPath."/div/a/img");
    }

    public function getFirstAddCartButton(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath",self::commonPath."//*[@title='Add to Cart']");
    }

    public function getFirstAddWishlistButton(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath",self::commonPath."//*[@title='Add to Wish List']");
    }

    public function getFirstProductName(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath",self::commonPath."//*[@class='product name product-item-name']");
    }

    public function getFirstProductPrice(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath",self::commonPath."//*[@class='price-box price-final_price']");
    }

    public function getNoResultsMsg(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath","//*[@class='message notice']");
    }

    public function getCategoryDescription(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='category-description']");
    }

    public function getFirstAddCartButtonNot(){
        return $this->find("xpath",self::commonPath."//*[@class='action tocart primary']");
    }

    public function getFirstProductPriceNot(){
        return $this->find("xpath",self::commonPath."//*[@class='price-wrapper ']");
    }

    public function getFirstProdStockUnavailableNot(){
        return $this->find("xpath",self::commonPath."//*[@class='stock unavailable']");
    }

    public function findTotalNoProductsPerPageText(){
        return $this->find("xpath","(//*[@class=\"toolbar-amount\"])[1]/span[3]");
    }

    public function getNoProductsPerPage(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","(//*[@class=\"toolbar-amount\"])[1]");
    }

    public function findCurrentListingPage(){
        return $this->find("xpath","(//*[@class=\"item current\"])[2]");
    }

    public function findOtherListingPage(){
        return $this->find("xpath","(//*[@class='items pages-items'])[2]//*[@class='item']");
    }

    public function getFirstProdStockUnavailable(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath",self::commonPath."//*[@class='stock unavailable']");
    }

    //price related
    public function getOldPriceOffer(){
        return $this->find("xpath","//*[@class='old-price']");
    }

    public function getFirstProdSpecialPrice(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath",self::commonPath."//*[@class='special-price']");
    }

    public function getFirstProdLowestPrice(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath",self::commonPath."//*[@class='my-tooltip minimal-price-info']/a/span/span");
    }

    public function getFirstProdMinPriceOff($row){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath",
            self::commonPath."//*[@class='tooltip-content minimal-price-list']/span[".$row."]/span");
    }

    public function getFirstProdMinPriceOff2(){
        return $this->waitUntilelementPresent(DataItems::waitTime,"xpath",
            self::commonPath."//*[@class='tooltip-content minimal-price-list']");
    }

    public function getAnyPrice($i){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='products list items product-items']/li[$i]//*[@class='price']");
    }

###### Filtering Options
##############################  Individual Main Filtering Options

    public function getSellerFilteringMenu(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"filter-options\"]/div/div[contains(text(),\"Seller\")]");
    }

##############################  General Main Filtering Options

    public function getAllFilteringOptions(){
        return $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","//*[@class=\"filter-options\"]//*[@data-role='title']");
    }

    public function getAnyMainFilteringOption($filterMain){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"filter-options\"]/div/div[contains(text(),\"$filterMain\")]");
    }
##############################  Sub Filtering Options

    public function getAnySellerSubOption($sellerSubFilter){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"filter-options\"]/div/div/ol/li/a[contains(text(),\"$sellerSubFilter\")]");
    }

##############################  Products per Page

    public function setNoProductsPerPage(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","(//*[@class=\"limiter-options\"])[last()]");
    }

    public function getProductsFromListing($expectedProductName){

        $productList = $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","//*[@class=\"products list items product-items\"]/li/div/div/strong/a");
        //echo for debug:
        echo "PRDUCT PRODUCT LIST HAS ".count($productList)."ELEMENTS. ";

        for ($i=0; $i < count($productList); $i++){
            if (isset($expectedProductName[$i])){
                $productName = $productList[$i]->getText();
                //echo for debug:
                echo "$productName";
                if ($productName === $expectedProductName[$i]){

                    echo "Match";

                } else {
                    throw new \RuntimeException(sprintf("Product name is different than the Expected Name"));
                }

            } else {
                throw new \RuntimeException(sprintf("There are more products than the vendor has"));
            }
        }
    }
###### Listing Elements

    public function getBreadcrumbCategory(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='page-title']/span");
    }

    public function getSortByOptions($expectedOptions){
        $options = $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","(//*[@id=\"sorter\"])[1]/option");

        for ($i = 0; $i < count($options); $i++){
            $sortByOptions = $options[$i]->getText();

            echo "  SortByoptions: ".$sortByOptions. "\r\n";
            echo "Expected Option: ".$expectedOptions[$i]. "\r\n";

            if ($sortByOptions === $expectedOptions[$i]){
                Echo "Options Matched \r\n";
            }else{
                throw new \RuntimeException(sprintf("Sort By options does not match"));
            }
        }
    }

    public function getAscendingDirectionDesc(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","(//*[@class='action sorter-action sort-desc'])[1]");
    }

    public function getAscendingDirectionAsc(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","(//*[@class='action sorter-action sort-asc'])[1]");
    }

    public function getCurrentListingPage(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","(//*[@class=\"item current\"])[2]/strong/span[2]");
    }

    public function getOtherListingPage(){
        return $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","(//*[@class='items pages-items'])[2]//*[@class='item']");
    }

    public function getNextPage(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","(//*[@class='item pages-item-next'])[2]");
    }

    public function getPreviousPage(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","(//*[@class='item pages-item-previous'])[2]");
    }

    public function getNoProductsPerPageOption(){
        return $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","(//*[@class=\"limiter-options\"])[2]/option");
    }

    public function getWishListAreaTitle(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='block block-wishlist']//*[@class='block-title']");
    }

    public function getWishListContent(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='block block-wishlist']//*[@class='block-content']");
    }

###### Product Information
##############################  Find Functions - Will return null if element is not found

    public function findAnyAddToWishListButton($i){
        return $this->find("xpath","//*[@class='products list items product-items']/li[$i]//*[@title='Add to Wish List']");
    }

    public function findAnyAddToComparison($i){
        return $this->find("xpath","//*[@class='products list items product-items']/li[$i]//*[@title='Add to Compare']");
    }

    public function findAnyProductImage($i){
        return $this->find("xpath","//*[@class='products list items product-items']/li[$i]//*[@class='photo image']");
    }

    public function findAnyProductName($i){
        return $this->find("xpath","//*[@class='products list items product-items']/li[$i]//*[@class='product-item-link']");
    }

    public function findAnyProductPrice($i){
        return $this->find("xpath","//*[@class='products list items product-items']/li[$i]//*[@class='price']");
    }

    public function findAnyProductLogo($i){
        return $this->find("xpath","//*[@class='products list items product-items']/li[$i]//*[@class='logo-attribute']");
    }

}