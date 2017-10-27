<?php

namespace BuyerPages;
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 05-May-17
 * Time: 6:05 PM
 */

use UtilsPage\DataItems;
use UtilsPage\Utils;

class HomePage extends Utils
{

    public function getTitle(){
        return $this->findElement("xpath","//*[@class='page-title']/span");
    }

    public function getFirstTopProduct(){
        return $this->findElement("xpath","//*[@class='product-items widget-product-grid']/li[1]");
    }

    public function getFirstTopProductFavorite(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='product-items widget-product-grid']/li[2]//*[@class='actions-secondary']/a[1]");
    }

    public function getMyCartQty(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class='counter qty']/span[1]");
    }

    public function getShopMessage(){
        return $this->findElement("xpath","//*[@class='message-success success message']/div");
    }

    public function getMyAccountButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='header links']/li/a[contains(text(),'My Account')]");
    }

    public function getShippingCurrencyBtn(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","(//*[@class='action toggle open-popup-shipping-currency'])[1]");
    }

    public function getChangeCurrencySelect(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id='modal-switcher-currency']");
    }

    public function getSaveCurrencyBtn(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@title='Save']");
    }

    public function getBecomeSellerLink(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class='panel header']/p/span/a");
    }

    public function getSearchOption(){
        return $this->findElement("xpath","//*[@id=\"search\"]");
    }

    public function getLogo(){
        return $this->findElement("xpath","//*[@class='logo']/img");
    }

    public function getSearchField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"search\"]");
    }

    public function getSearchButton(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@title=\"Search\"]");
    }

    public function getCookieOk(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"cookie-ok\"]");
    }

    public function getCookieReadMore(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"cookie-read-more\"]");
    }

    public function getTermsBar(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"cookie-message\"]");
    }

    public function termsBarDisappears(){
        return $this->assertStyleValue("//*[@class=\"cookie-message-container\"]","bottom: -100px;");
    }

    public function waitForLoad(){
        $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"loading-mask\"]");
        $this->waitUntilElementInvisible(DataItems::waitTime,"xpath","//*[@class=\"loading-mask\"]");
    }

    public function waitForCartSummaryLoad(){
       return  $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"cart-totals\"]/div/table/tbody/tr[2]/th/span[2]");
    }

    public function getMenuTitle(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"page-title-wrapper\"]");
    }


###### Homepage Menu Buttons Section
##############################  Runs through all menu buttons and checks page title and URL

    public function checkMenuOptions($menuOptions,$expectedTitles,$expectedUrls){
        $options = $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","//*[@class=\"sections nav-sections\"]//*[@class=\"navigation\"]/ul/li");
        for ( $i =0; $i < count($options); $i++ ){
            $menuButton = $options[$i]->getText();

            echo "   Found: " . $menuButton . "\r\n";
            echo "Expected: " . $menuOptions[$i] . "\r\n";

            if ($menuButton === $menuOptions[$i]){
                echo "Match" . "\r\n";

                $options[$i]->click();
                $foundTitle = self::getMenuTitle()->getText();
                $foundUrl = $this->getSession()->getCurrentUrl();

                echo "   Found URL:   " . $foundUrl . "\r\n";
                echo "Expected URL:   " . $expectedUrls[$i] . "\r\n";
                echo "   Found Title: " . $foundTitle . "\r\n";
                echo "Expected Title: " . $expectedTitles[$i] . "\r\n";

                if ($foundTitle === $expectedTitles[$i] and $foundUrl === $expectedUrls[$i]){

                    echo "Match URL and Title \r\n";
                }else {
                    throw new \RuntimeException(sprintf('Mismatch URL or Title'));
                }
            }else {
                throw new \RuntimeException(sprintf('Mismatch Menu button'));
            }
        }
    }

##############################  Individual Menu Buttons

    public function getDevicesMenuOption(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"sections nav-sections\"]//*[@class=\"navigation\"]/ul/li/a/span[contains(text(),\"Devices\")]");
    }

    public function getGatewaysMenuOption(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"sections nav-sections\"]//*[@class=\"navigation\"]/ul/li/a/span[contains(text(),\"Gateways\")]");
    }

    public function getThingParkConnectedMenuOption(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"sections nav-sections\"]//*[@class=\"navigation\"]/ul/li/a/span[contains(text(),\"ThingPark Connected\")]");
    }

    public function getSolutionsMenuOption(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"sections nav-sections\"]//*[@class=\"navigation\"]/ul/li/a/span[contains(text(),\"Solutions\")]");
    }

    public function getSellersMenuOption(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"sections nav-sections\"]//*[@class=\"navigation\"]/ul/li/a/span[contains(text(),\"Sellers\")]");
    }

##############################  General Menu Button

    public function getAnyMenuButton($menuButton){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"sections nav-sections\"]//*[@class=\"navigation\"]/ul/li/a/span[contains(text(),'$menuButton')]");
    }

###### Advanced Search

    public function getAdvancedSearchButton(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"advanced-search-button\"]");
    }
    public function getAdvSearchName(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"block-customer-advanced-search\"]");
    }

    public function getAdvNameField(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"name\"]");
    }

    public function getAdvSkuField(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"sku\"]");
    }

    public function getAdvDescriptionField(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"description\"]");
    }

    public function getAdvShortDescriptionField(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"short_description\"]");
    }

    public function getAdvFirstUnitPriceField(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"price\"]");
    }

    public function getAdvSecondUnitPriceField(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"price_to\"]");
    }

    public function getAdvRadioFrqBand(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"ac_band\"]");
    }

    public function getAdvCertification(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"ac_thirdparty_approve\"]");
    }

    public function getAdvSearchSearchButton(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"form-validate\"]//*[@title='Search']");
    }

    public function getAdvNoProdFoundMessage(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"message error\"]");
    }

    public function getAdvProdFoundMessage(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"message notice\"]");
    }

    public function getModifyYourSearch(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"modify-advanced-search-btn\"]");
    }

##############################  Check available fields from Advanced Search Popup

    public function checkAdvanceSearchFields($expectedFields){

        $list = $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","//*[@class='form search advanced']//*[@class=\"fieldset\"]/div/label");

        for ($i = 0; $i < count($list); $i ++){
            $fieldName = $list[$i]->getText();

            if ($fieldName === $expectedFields[$i]){
                    Echo "Fields Match \r\n";
            }else {
                    throw new \RuntimeException(sprintf('Mismatch Fields'));
            }
        }
    }


    ##############################  SilviuS: Get Product Add to Compare Button
    public function getAddToCompareButton(){
        $element = $this->getSession()->getPage()->find("xpath", "//*[@class=\"product-item-info\"]");
        $element->mouseOver();
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"action tocompare\"]");
    }

    ##############################  SilviuS: Get Added to Compare Confirmation Message
    public function getAddToCompareConfirmation(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"message-success success message\"]");
    }
}