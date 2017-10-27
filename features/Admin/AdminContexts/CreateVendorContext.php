<?php
/**
 * Created by PhpStorm.
 * User: gabriel.curdov
 * Date: 19.05.2017
 * Time: 16:17
 */

namespace AdminTests;

use AdminPages\AdminValues;
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use SellerPages\SellerValues;
use UtilsPage\Utils;
use UtilsPage\DataItems;
use AdminPages\HomePage;
use AdminPages\VendorPage;
use AdminPages\AddVendorPage;
use AdminPages\VendorRegistrationsPage;

class CreateVendorContext extends RawMinkContext implements Context
{
    private $utils;
    private $homepage;
    private $vendorPage;
    private $addVendorPage;
    private $vendorRegistrationsPage;

    public function __construct(
        VendorRegistrationsPage $vendorRegistrationsPage,
        AddVendorPage $addVendorPage,
        VendorPage $vendorPage,
        HomePage $homePage,
        Utils $utils
    )
    {
        $this->vendorRegistrationsPage= $vendorRegistrationsPage;
        $this->addVendorPage= $addVendorPage;
        $this->vendorPage = $vendorPage;
        $this->homepage = $homePage;
        $this->utils = $utils;
    }

    /**
     * @Given /^I go to Vendor page$/
     */
    public function iGoToVendorPage()
    {
        $this->homepage->getSalesMenu()->click();
        $this->homepage->getVendorMenu()->click();
    }

    /**
     * @Given /^I add a New Vendor$/
     */
    public function iAddANewVendor()
    {
        DataItems::$vendRandName = $this->utils->randomInt().DataItems::dummyVendorName;
        DataItems::$vendRandEmail = $this->utils->randomInt().DataItems::dummyVendorEmail;
        $this->vendorPage->getAddVendorBtn()->click();

        $this->addVendorPage->getVendNameField()->setValue(DataItems::$vendRandName);
        $this->addVendorPage->getVendEmailField()->setValue(DataItems::$vendRandEmail);
        $this->addVendorPage->getPassField()->setValue(DataItems::dummyVendorPass);
        $this->addVendorPage->getPreferredCarrierSelect()->selectOption(DataItems::dummyVendorCarr);
        $this->addVendorPage->getShipOrgStreetField()->setValue(DataItems::vendorShipStreet);
        $this->addVendorPage->getShipOrgCityField()->setValue(DataItems::vendorShipCity);
        $this->addVendorPage->getBillingStreetField()->setValue(DataItems::vendorBillStreet);
        $this->addVendorPage->getBillingCityField()->setValue(DataItems::vendorBillCity);
        $this->addVendorPage->getVendFaxField()->setValue(DataItems::dummyVendorFax);
        $this->addVendorPage->getVendZip()->setValue(DataItems::dummyVendorZip);
        $this->addVendorPage->getVendBillZip()->setValue(DataItems::dummyVendorBillZip);
        $this->addVendorPage->getVendTaxClass()->selectOption(DataItems::vendorTaxClass);

        $this->addVendorPage->getSaveVendBtn()->click();
    }

    /**
     * @Then /^The vendor is created with the details i entered$/
     */
    public function theVendorIsCreatedWithTheDetailsIEntered()
    {
        $message = $this->vendorPage->getVendorMessage()->getText();
        expect($message)->shouldBe(DataItems::vendorSaveMsg);

        $name = $this->vendorPage->getVendorName(1)->getText();
        $email = $this->vendorPage->getVendorEmail(1)->getText();
        $carrier = $this->vendorPage->getVendorUsedCarr(1)->getText();

        expect($name)->shouldBe(DataItems::$vendRandName);
        expect($email)->shouldBe(DataItems::$vendRandEmail);
        expect($carrier)->shouldBe(DataItems::dummyVendorCarr);
    }

    /**
     * @Given /^I Edit the created vendor$/
     */
    public function iEditTheCreatedVendor()
    {
        $edit = DataItems::edited;

        $this->vendorPage->editVendor(DataItems::$vendRandEmail);
        $this->addVendorPage->getVendNameField()->setValue($edit.DataItems::$vendRandName);
        $this->addVendorPage->getVendEmailField()->setValue($edit.DataItems::$vendRandEmail);
        $this->addVendorPage->getPreferredCarrierSelect()->selectOption(DataItems::dummyVendorCarrEdit);
        $this->addVendorPage->getShipOrgStreetField()->setValue($edit.DataItems::vendorShipStreet);
        $this->addVendorPage->getShipOrgCityField()->setValue($edit.DataItems::vendorShipCity);
        $this->addVendorPage->getBillingStreetField()->setValue($edit.DataItems::vendorBillStreet);
        $this->addVendorPage->getBillingCityField()->setValue($edit.DataItems::vendorBillCity);
        $this->addVendorPage->getVendPhoneFiedl()->setValue(DataItems::dummyVendorPhone);
        $this->addVendorPage->getVendFaxField()->setValue($edit.DataItems::dummyVendorFax);
    }

    /**
     * @Given /^I save the changes made to vendor account$/
     */
    public function iSaveTheChangesMadeToVendorAccount()
    {
        $this->addVendorPage->getSaveVendBtn()->click();
    }

    /**
     * @Then /^I check that changes have been saved$/
     */
    public function iCheckThatChangesHaveBeenSaved()
    {
        $edit = DataItems::edited;

        $this->vendorPage->editVendor($edit.DataItems::$vendRandEmail);

        $name = $this->addVendorPage->getVendNameField()->getAttribute("value");
        $email = $this->addVendorPage->getVendEmailField()->getAttribute("value");
        $carrier = $this->addVendorPage->getPrefCarrSelectedOpt()->getText();
        $shipStreet = $this->addVendorPage->getShipOrgStreetField()->getText();
        $shipCity = $this->addVendorPage->getShipOrgCityField()->getAttribute("value");
        $billStreet = $this->addVendorPage->getBillingStreetField()->getText();
        $billCity = $this->addVendorPage->getBillingCityField()->getAttribute("value");
        $phone = $this->addVendorPage->getVendPhoneFiedl()->getAttribute("value");
        $fax = $this->addVendorPage->getVendFaxField()->getAttribute("value");

        expect($name)->shouldBe($edit.DataItems::$vendRandName);
        expect($email)->shouldBe($edit.DataItems::$vendRandEmail);
        expect($carrier)->shouldBe(DataItems::dummyVendorCarrEdit);
        expect($shipStreet)->shouldBe($edit.DataItems::vendorShipStreet);
        expect($shipCity)->shouldBe($edit.DataItems::vendorShipCity);
        expect($billStreet)->shouldBe($edit.DataItems::vendorBillStreet);
        expect($billCity)->shouldBe($edit.DataItems::vendorBillCity);
        expect($phone)->shouldBe(DataItems::dummyVendorPhone);
        expect($fax)->shouldBe($edit.DataItems::dummyVendorFax);

    }

    /**
     * @Given /^I check that the product is added to the vendor$/
     */
    public function iCheckThatTheProductIsAddedToTheVendor()
    {
        $this->addVendorPage->getAsocProdMenu()->click();
        $product = $this->addVendorPage->getProductName(1)->getText();
        expect($product)->shouldBe(DataItems::$noPriceProdRand);

    }

    /**
     * @Given /^I click on view on the created vendor$/
     */
    public function iClickOnViewOnTheCreatedVendor()
    {
        $this->vendorPage->editVendor(DataItems::$vendRandEmail);
    }

    /**
     * @When /^I go to Sales > Vendors page$/
     */
    public function iGoToSalesVendorsPage()
    {
        $this->homepage->getSalesMenu()->click();
        $this->homepage->getVendorMenu()->click();

    }

    /**
     * @Given /^I Edit a Vendor$/
     */
    public function iEditAVendor()
    {
        $this->vendorPage->getViewButton(1)->click();
    }

    /**
     * @Then /^Require admin approval for vendor\-customer communication dropdown is present with options Yes and No$/
     */
    public function requireAdminApprovalForVendorCustomerCommunicationDropdownIsPresentWithOptionsYesAndNo()
    {
        $label = $this->addVendorPage->getAdminApproveComLabel()->getText();
        expect($label)->shouldBe(AdminValues::adminApproveComLabel);
        $options = $this->addVendorPage->getAdminApproveComDropdownOptions();

        expect($options[0]->getText())->shouldBe("Yes");
        expect($options[1]->getText())->shouldBe("No");
    }

    /**
     * @Then /^I search for the vendor of the bought product and edit$/
     */
    public function iSearchForTheVendorOfTheBoughtProductAndEdit()
    {
        $this->vendorPage->getVendorEmailField()->setValue(DataItems::sellerMail);
        $this->vendorPage->getSearchBtn()->click();
        $this->vendorPage->waitForLoad();
        $this->vendorPage->getViewButton(1)->click();
    }

    /**
     * @Given /^I set the Require admin approval for vendor\-customer communication option set to "([^"]*)" and save$/
     */
    public function iSetTheRequireAdminApprovalForVendorCustomerCommunicationOptionSetToAndSave($value)
    {
        $this->addVendorPage->getAdminApproveComDropdown()->selectOption($value);

        $this->addVendorPage->getSaveVendBtn()->click();
        $msg = $this->vendorPage->getMessage()->getText();
        expect($msg)->shouldBe(AdminValues::vendorSavedMsg);
    }

    /**
     * @When /^I go to Vendor Registrations page$/
     */
    public function iGoToVendorRegistrationsPage()
    {
        $this->homepage->getSalesMenu()->click();
        $this->homepage->getVendorRegistrationsMenu()->click();
    }

    /**
     * @Given /^I search for the previously registered vendor$/
     */
    public function iSearchForThePreviouslyRegisteredVendor()
    {
        $this->vendorRegistrationsPage->getVendorEmailField()->setValue(SellerValues::$randSellerEmail);
        $this->vendorRegistrationsPage->getSearchBtn()->click();
    }

    /**
     * @Then /^I Edit the registered vendor$/
     */
    public function iEditTheRegisteredVendor()
    {
        $this->vendorRegistrationsPage->waitForLoad();
        $this->vendorRegistrationsPage->getVendorEmail(1)->click();
    }

    /**
     * @Given /^I activate the seller, set his password and save$/
     */
    public function iActivateTheSellerSetHisPasswordAndSave()
    {
        $this->addVendorPage->getVendStatusDropdown()->selectOption("Active");
        $this->addVendorPage->getPassField()->setValue(SellerValues::dummyPassword);
        $this->addVendorPage->getSaveVendBtn()->click();
        $msg = $this->vendorPage->getMessage()->getText();
        expect($msg)->shouldBe(AdminValues::vendorSavedMsg);
    }

    /**
     * @Given /^I reject the seller, set his password, the reason and save$/
     */
    public function iRejectTheSellerSetHisPasswordTheReasonAndSave()
    {
        $this->addVendorPage->getVendStatusDropdown()->selectOption("Rejected");
        $this->addVendorPage->getPassField()->setValue(SellerValues::dummyPassword);
        $this->addVendorPage->getRejectReasonField()->setValue(SellerValues::dummyRejectReason);
        $this->addVendorPage->getSaveVendBtn()->click();
        $msg = $this->vendorPage->getMessage()->getText();
        expect($msg)->shouldBe(AdminValues::vendorSavedMsg);
    }

    /**
     * @Then /^i do that$/
     */
    public function iDoThat()
    {
        throw new PendingException();
    }

    /**
     * @When /^sdfasdfsda$/
     */
    public function sdfasdfsda()
    {
        throw new PendingException();
    }

    /**
     * @Given /^sdfasdfs$/
     */
    public function sdfasdfs()
    {
        throw new PendingException();
    }

    /**
     * @Then /^i do that "([^"]*)"$/
     */
    public function iDoThat1($arg1)
    {
        sendkeys($arg1);
    }


}