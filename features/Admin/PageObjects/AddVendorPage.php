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

class AddVendorPage extends Utils
{
    /**
     * Vendor information tab
     */
    public function getVendNameField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendor_name\"]");
    }

    public function getVendStatusDropdown(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"status\"]");
    }

    public function getPreferredCarrierSelect(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"carrier_code\"]");
    }

    public function getVendEmailField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"email\"]");
    }

    public function getPassField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"password\"]");
    }

    public function getRejectReasonField(){
        return $this->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"reject_reason\"]");
    }

    public function getShipOrgStreetField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"street\"]");
    }

    public function getShipOrgCityField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"city\"]");
    }

    public function getBillingStreetField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"billing_street\"]");
    }

    public function getBillingCityField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"billing_city\"]");
    }

    public function getVendPhoneFiedl(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"telephone\"]");
    }

    public function getVendFaxField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"fax\"]");
    }

    public function getPrefCarrSelectedOpt(){
        return $this->getSelectedOption("xpath","//*[@id=\"carrier_code\"]");
    }

    public function getVendZip(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id=\"adminhtml-vendor-edit-tab-form-0-fieldset-element-text-zip\"]");
    }

    public function getVendBillZip(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id=\"adminhtml-vendor-edit-tab-form-0-fieldset-element-text-billing-zip\"]");
    }

    public function getVendTaxClass(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"vendor_tax_class\"]");
    }

    public function getSaveVendBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"save\"]");
    }

    public function getAdminApproveComLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@for=\"communication_approval\"]");
    }

    public function getAdminApproveComDropdown(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"communication_approval\"]");
    }

    public function getAdminApproveComDropdownOptions(){
        return $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","//*[@id=\"communication_approval\"]/option");
    }

    /**
     * Associated Product Tab
     */
    public function getAsocProdMenu(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@title=\"Associated Products\"]");
    }

    public function getProductName($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"udropship_vendor_products_table\"]/tbody/tr[".$row."]/td[3]");
    }
}