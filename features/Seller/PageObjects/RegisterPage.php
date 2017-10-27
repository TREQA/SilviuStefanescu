<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/15/2017
 * Time: 4:26 PM
 */

namespace SellerPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class RegisterPage extends Utils
{
    public function getFirstNameField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendor_first_name\"]");
    }

    public function getLastNameField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendor_last_name\"]");
    }

    public function getEmailField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"email\"]");
    }

    public function getPhoneField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"telephone\"]");
    }

    public function getCompanyNameField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendor_name\"]");
    }

    public function getCountryDropdown(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"country_id\"]");
    }

    public function getCityField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"city\"]");
    }

    public function getAddressField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"street1\"]");
    }

    public function getZipCodeField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"zip\"]");
    }

    public function getAgreeTcCheckbox($status){
        $this->checkboxScript('#agree_terms_conditions_1',$status);
    }

    public function getCommentsField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"comments\"]");
    }

    public function getRegisterBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@name=\"send\"]");
    }

    public function getBackToLoginBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"btn btn-link btn-block\"]");
    }

    /**
     * Labels
     */
    public function getPageTitle(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"panel-heading\"]");
    }

    public function getMandatoryFieldLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"required-field-notice\"]");
    }

    public function getContactInfLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@alt=\"Contact information\"]/div[1]");
    }

    public function getCompanyInfLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@alt=\"Company information\"]/div[1]");
    }

    public function getTcLink(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@for=\"agree_terms_conditions_1\"]");
    }

    public function getCommentLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id=\"vendor-register-renderer-fieldsetelement-0-textarea-comments-label\"]");
    }

    public function getFirstNameLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@for=\"vendor_first_name\"]");
    }

    public function getLastNameLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@for=\"vendor_last_name\"]");
    }

    public function getEmailAddressLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@for=\"email\"]");
    }

    public function getPhoneLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@for=\"telephone\"]");
    }

    public function getCompanyNameLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@for=\"vendor_name\"]");
    }

    public function getCountryLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@for=\"country_id\"]");
    }

    public function getZipCodeLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@for=\"zip\"]");
    }

    public function getCityLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@for=\"city\"]");
    }

    public function getAddressLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@for=\"street1\"]");
    }

    // Captcha

    public function iSwitchToTheFirstIframe() {
        $javascript = <<<JS
        (function(){
                    var iframes = document.getElementsByTagName('iframe');
                    var f = iframes[0];
                    f.id = "no_name_iframe";
})()
JS;
        $this->getSession()->executeScript($javascript);
        $this->getSession()->switchToIFrame('no_name_iframe');
    }

    public function getReCaptcha(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@class=\"rc-anchor-center-item rc-anchor-checkbox-label\"]");
    }
    public function getCaptchaChecked(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@aria-checked='true']");
    }
}