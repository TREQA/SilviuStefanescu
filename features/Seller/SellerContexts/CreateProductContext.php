<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 23.05.2017
 * Time: 09:46
 */

namespace SellerTests;


use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use UtilsPage\Utils;
use UtilsPage\DataItems;
use SellerPages\SellerValues;
use SellerPages\HomePage;
use SellerPages\ProductManagerPage;
use SellerPages\AddProductPage;
use SellerPages\StockPage;


class CreateProductContext extends RawMinkContext implements Context
{
    private $utils;
    private $homePage;
    private $productManagerPage;
    private $addProductPage;
    private $stockPage;

    public function __construct(StockPage $stockPage, AddProductPage $addProductPage,ProductManagerPage $productManagerPage, HomePage $homePage,Utils $utils)
    {
        $this->stockPage = $stockPage;
        $this->addProductPage = $addProductPage;
        $this->productManagerPage = $productManagerPage;
        $this->homePage = $homePage;
        $this->utils = $utils;
    }

    /**
     * @Given /^I go to Product Manager page$/
     */
    public function iGoToProductManagerPage()
    {
        $this->homePage->getProductManagerMenu()->click();
    }

    /**
     * @Given /^I create a new product with no price$/
     */
    public function iCreateANewProductWithNoPrice()
    {
        $this->productManagerPage->getProductTypeDropdown()->selectOption("Product");
        $this->productManagerPage->getSecProductTypeDropdown()->selectOption("Product - No Price");
        $this->productManagerPage->getAddNewProdNoPriceButton()->click();
    }

    /**
     * @Given /^I add a new "([^"]*)" product$/
     */
    public function iAddANewProduct1($arg1)
    {
        $this->productManagerPage->getProductTypeDropdown()->selectOption("Product");

        switch ($arg1){
            case "Device":
                $this->productManagerPage->getSecProductTypeDropdown()->selectOption($arg1);
                $this->productManagerPage->getAddNewProdButton()->click();
                break;
            case "GateWay":
                $this->productManagerPage->getSecProductTypeDropdown()->selectOption($arg1);
                $this->productManagerPage->getAddNewProdButton()->click();
                break;
            case "Product - No Price":
                $this->productManagerPage->getSecProductTypeDropdown()->selectOption($arg1);
                $this->productManagerPage->getAddNewProdNoPriceButton()->click();
                break;
        }

    }

    /**
     * @Then /^I see the add product page information$/
     */
    public function iSeeTheAddProductPageInformation()
    {
        $this->addProductPage->getProdInfSect();
        $this->addProductPage->getPriceSect();
        $this->addProductPage->getDimSect();
        $this->addProductPage->getAdditDataSect();
        $this->addProductPage->getShipLeadTimeInfSect();
        $this->addProductPage->getSeoSect();
        $this->addProductPage->getTechDocsSect();
        $this->addProductPage->getImgsSect();
    }

    /**
     * @Given /^I complete all the mandatory fields for the product$/
     */
    public function iCompleteAllTheMandatoryFieldsForTheProduct()
    {
        SellerValues::$randProdName = $this->utils->randomInt().SellerValues::dummyDeviceProduct;

        $this->addProductPage->getProdNameField()->setValue(SellerValues::$randProdName);
        $this->addProductPage->getManufPartNoField()->setValue(SellerValues::dummyDeviceManNo);
        $this->addProductPage->getUnitPriceField()->setValue(SellerValues::dummyUnitPrice);
        $this->addProductPage->getWeightField()->setValue(SellerValues::dummyWeight);
        $this->addProductPage->getRadioFreqBandDropdown()->selectOption(SellerValues::radioFreqEU);
        $this->addProductPage->getBatteryTypeDropdown()->selectOption(SellerValues::batteryRechLi);
    }

    /**
     * @Given /^I click on Save$/
     */
    public function iClickOnSave()
    {
        $this->addProductPage->getSaveButton()->click();
    }

    /**
     * @Then /^a confirmation message appears and the product is created$/
     */
    public function aConfirmationMessageAppearsAndTheProductIsCreated()
    {
        $creationMsg = $this->productManagerPage->getMsg()->getText();
        expect($creationMsg)->shouldBe(SellerValues::productSavedMsg);


        $this->productManagerPage->getProdNameLink(1)->click();

        $name = $this->addProductPage->getProdNameField()->getAttribute("value");
        //$manNo = $this->addProductPage->getManufPartNoField()->getAttribute("value");
        $price = $this->addProductPage->getUnitPriceField()->getAttribute("value");
        $weight = $this->addProductPage->getWeightField()->getAttribute("value");
        $freq = $this->addProductPage->getSelectedRadioFreqBand()->getText();
        $battery = $this->addProductPage->getSelectedBatteryType()->getText();

        expect($name)->shouldBe(SellerValues::$randProdName);
        //expect($manNo)->shouldBe(SellerValues::dummyDeviceManNo);
        expect($price)->shouldBe(SellerValues::dummyUnitPrice);
        expect($weight)->shouldBe(SellerValues::dummyWeight);
        expect($freq)->shouldBe(SellerValues::radioFreqEU);
        expect($battery)->shouldBe(SellerValues::batteryRechLi);
    }

    /**
     * @Given /^I go to Stock menu$/
     */
    public function iGoToStockMenu()
    {
        $this->homePage->getStockMenu()->click();
    }

    /**
     * @Given /^I search for the product stock$/
     */
    public function iSearchForTheProductStock()
    {
        $this->visitPath("/udropship/vendor/product/?filter_name=".SellerValues::$randProdName."&submit_action=search");
    }

    /**
     * @Then /^I add stock qty and change the status to In stock$/
     */
    public function iAddStockQtyAndChangeTheStatusToInStock()
    {
        $this->stockPage->getProdStatusDropdown(1)->selectOption("In stock");
        $this->stockPage->getProdQty(1)->setValue(SellerValues::stockQty);
        $this->stockPage->getUpdateInfBtn()->click();
        sleep(2);
    }

    /**
     * @Given /^I search for the previously added product$/
     */
    public function iSearchForThePreviouslyAddedProduct()
    {
        $this->visitPath("/udprod/vendor/products/?filter_name=".SellerValues::$randProdName."&submit_action=search");
    }

    /**
     * @Then /^the product is out of stock$/
     */
    public function theProductIsOutOfStock()
    {
        $status = $this->productManagerPage->getProdStkStatus(1)->getText();
        expect($status)->shouldBe("Out of stock");
    }

    /**
     * @Given /^the product is in stock$/
     */
    public function theProductIsInStock()
    {
        $status = $this->productManagerPage->getProdStkStatus(1)->getText();
        expect($status)->shouldBe("In stock");

        $qty = $this->productManagerPage->getProdStkQty(1)->getText();
        expect($qty)->shouldBe(SellerValues::stockQty);
    }

    /**
     * @Then /^I complete all mandatory fields for a product with no price and save$/
     */
    public function iCompleteAllMandatoryFieldsForAProductWithNoPriceAndSave()
    {
        SellerValues::$randProdName = $this->utils->randomInt().SellerValues::dummyDeviceProduct;

        $this->addProductPage->getProdNameField()->setValue(SellerValues::$randProdName);
        $this->addProductPage->getSaveButton()->click();

        $creationMsg = $this->productManagerPage->getMsg()->getText();
        expect($creationMsg)->shouldBe(SellerValues::productSavedMsg);
    }

    /**
     * @Then /^I add advanced pricing settings$/
     */
    public function iAddAdvancedPricingSettings()
    {

        $this->utils->scrollToTop();
        $this->utils->waitForJQuery();

        $this->addProductPage->getAddPriceButton()->click();
        $this->addProductPage->getAdvPriceQtyField(1)->setValue(SellerValues::advPriceQtyOne);
        $this->addProductPage->getAdvPriceField(1)->setValue(SellerValues::advPriceOne);

        $this->addProductPage->getAddPriceButton()->click();
        $this->addProductPage->getAdvPriceQtyField(2)->setValue(SellerValues::advPriceQtyTwo);
        $this->addProductPage->getAdvPriceField(2)->setValue(SellerValues::advPriceTwo);

        $this->addProductPage->getAddPriceButton()->click();
        $this->addProductPage->getAdvPriceQtyField(3)->setValue(SellerValues::advPriceQtyThree);
        $this->addProductPage->getAdvPriceField(3)->setValue(SellerValues::advPriceThree);

        $this->addProductPage->getAddPriceButton()->click();
        $this->addProductPage->getAdvPriceQtyField(4)->setValue(SellerValues::advPriceQtyDef);
        $this->addProductPage->getAdvPriceField(4)->setValue(SellerValues::advPriceDef);
    }

    /**
     * @Then /^I edit the advanced pricing product$/
     */
    public function iEditTheAdvancedPricingProduct()
    {
        $this->visitPath("/udprod/vendor/products/?filter_name=".SellerValues::$randProdName."&submit_action=search");
        $this->productManagerPage->getProdNameLink(1)->click();
    }

    /**
     * @Given /^I check that the advanced pricing settings have been saved$/
     */
    public function iCheckThatTheAdvancedPricingSettingsHaveBeenSaved()
    {
        $qty1 = $this->addProductPage->getAdvPriceQtyField(1)->getAttribute("value");
        $price1 = $this->addProductPage->getAdvPriceField(1)->getAttribute("value");

        expect($qty1)->shouldBe(SellerValues::advPriceQtyDef);
        expect($price1)->shouldBe(SellerValues::advPriceDef);

        $qty2 = $this->addProductPage->getAdvPriceQtyField(2)->getAttribute("value");
        $price2 = $this->addProductPage->getAdvPriceField(2)->getAttribute("value");

        expect($qty2)->shouldBe(SellerValues::advPriceQtyOne);
        expect($price2)->shouldBe(SellerValues::advPriceOne);

        $qty3 = $this->addProductPage->getAdvPriceQtyField(3)->getAttribute("value");
        $price3 = $this->addProductPage->getAdvPriceField(3)->getAttribute("value");

        expect($qty3)->shouldBe(SellerValues::advPriceQtyTwo);
        expect($price3)->shouldBe(SellerValues::advPriceTwo);

        $qty4 = $this->addProductPage->getAdvPriceQtyField(4)->getAttribute("value");
        $price4 = $this->addProductPage->getAdvPriceField(4)->getAttribute("value");

        expect($qty4)->shouldBe(SellerValues::advPriceQtyThree);
        expect($price4)->shouldBe(SellerValues::advPriceThree);
    }

    /**
     * @Given /^a confirmation message appears regarding product creation$/
     */
    public function aConfirmationMessageAppearsRegardingProductCreation()
    {
        $creationMsg = $this->productManagerPage->getMsg()->getText();
        expect($creationMsg)->shouldBe(SellerValues::productSavedMsg);
    }

    /**
     * @Given /^I complete all the mandatory fields for the advanced pricing product$/
     */
    public function iCompleteAllTheMandatoryFieldsForTheAdvancedPricingProduct()
    {
        SellerValues::$randProdName = SellerValues::dummyAdvDeviceProduct.$this->utils->randomInt();

        $this->addProductPage->getProdNameField()->setValue(SellerValues::$randProdName);
        $this->addProductPage->getManufPartNoField()->setValue(SellerValues::dummyDeviceManNo);
        $this->addProductPage->getUnitPriceField()->setValue(SellerValues::dummyUnitPrice);
        $this->addProductPage->getWeightField()->setValue(SellerValues::dummyWeight);
        $this->addProductPage->getRadioFreqBandDropdown()->selectOption(SellerValues::radioFreqEU);

        $this->addProductPage->getAddPriceButton()->click();
        $this->addProductPage->getAdvPriceQtyField(1)->setValue(SellerValues::advPriceQtyOne);
        $this->addProductPage->getAdvPriceField(1)->setValue(SellerValues::advPriceOne);

        $this->addProductPage->getAddPriceButton()->click();
        $this->addProductPage->getAdvPriceQtyField(2)->setValue(SellerValues::advPriceQtyTwo);
        $this->addProductPage->getAdvPriceField(2)->setValue(SellerValues::advPriceTwo);

        $this->addProductPage->getAddPriceButton()->click();
        $this->addProductPage->getAdvPriceQtyField(3)->setValue(SellerValues::advPriceQtyThree);
        $this->addProductPage->getAdvPriceField(3)->setValue(SellerValues::advPriceThree);

        $this->addProductPage->getAddPriceButton()->click();
        $this->addProductPage->getAdvPriceQtyField(4)->setValue(SellerValues::advPriceQtyDef);
        $this->addProductPage->getAdvPriceField(4)->setValue(SellerValues::advPriceDef);

        $this->addProductPage->getBatteryTypeDropdown()->selectOption(SellerValues::batteryRechLi);
    }

    /**
     * @Given /^as a seller I select the Product Attributes and Solutions Represented$/
     */
    public function asASellerISelectTheProductAttributesAndSolutionsRepresented()
    {
        $this->addProductPage->getProdAttrSelect()->selectOption("Dev kit",true);
        $this->addProductPage->getProdAttrSelect()->selectOption("Geolocation",true);

        $this->addProductPage->getProdSolSelect()->selectOption("Smart Agriculture",true);
        $this->addProductPage->getProdSolSelect()->selectOption("Energy and Utilities",true);
    }

    /**
     * @Given /^I "([^"]*)" the previously added "([^"]*)" product$/
     */
    public function iThePreviouslyAddedProduct($arg1, $arg2)
    {
        $this->productManagerPage->getProdDisableEnableBtn(1)->click();
        $this->getSession()->getDriver()->getWebDriverSession()->accept_alert();
    }

    /**
     * @Then /^"([^"]*)" message is shown$/
     */
    public function messageIsShown($arg1)
    {
        $foundMsg = $this->productManagerPage->getMsg()->getText();
        $expectedMsg = "";

        //$expectedMsg = substr_replace(SellerValues::disableMsg,SellerValues::$randProdName." ",8,0);
        switch ($arg1){
            case "disable":
                $expectedMsg = sprintf(SellerValues::disableMsg,SellerValues::$randProdName);
                break;
            case "enable" :
                $expectedMsg = sprintf(SellerValues::enableMsg,SellerValues::$randProdName);
        }

        expect($foundMsg)->shouldBe($expectedMsg);
    }

    /**
     * @Given /^admin receives email regarding product being "([^"]*)"$/
     */
    public function adminReceivesEmailRegardingProductBeing($arg1)
    {
        $this->getSession()->visit("http://mh.int.actility.com/#");
        sleep(10);
        $this->utils->waitUntilElementPresent(DataItems::waitTime,"xpath","/html/body/div/div/div[2]/div[2]/div[1]/div[2]/span")->click();

        $msg = $this->utils->waitUntilElementPresent(DataItems::waitTime,"xpath","/html/body/table/tbody/tr/td/table/tbody/tr[2]/td/table/tbody/tr/td/table/tbody/tr[2]/td/table/tbody/tr/td")->getText();
        expect($msg)->shouldBe("something@something.com changed status of product: 1551208DummyDevice to ".$arg1);
    }

    /**
     * @Given /^Disable and Enable buttons are not present for the created product$/
     */
    public function disableAndEnableButtonsAreNotPresentForTheCreatedProduct()
    {
        sleep(3);
        $notBtn = $this->productManagerPage->getNotDisableEnableBtn(1);
        expect($notBtn)->shouldBe(null);
    }

    /**
     * @Given /^System Status, Stock Status and Stock Qty values are "([^"]*)"$/
     */
    public function systemStatusStockStatusAndStockQtyValuesAre($status)
    {
        $sysStat = $this->productManagerPage->getProdSystemStatus(1)->getText();
        $stkStat = $this->productManagerPage->getProdStkStatus(1)->getText();
        $qtyStat = $this->productManagerPage->getProdStkQty(1)->getText();

        expect($sysStat)->shouldBe($status);
        expect($stkStat)->shouldBe($status);
        expect($qtyStat)->shouldBe($status);
    }

    /**
     * @Then /^Disable button is present and Enable button is not for the created product$/
     */
    public function disableButtonIsPresentAndEnableButtonIsNotForTheCreatedProduct()
    {
        $btn = $this->productManagerPage->getProdDisableEnableBtn(1)->getText();
        expect($btn)->shouldBe("Disable");
    }

    /**
     * @Given /^System Status is "([^"]*)"$/
     */
    public function systemStatusIs($status)
    {
        $sysStat = $this->productManagerPage->getProdSystemStatus(1)->getText();
        expect($sysStat)->shouldBe($status);
    }

    /**
     * @Then /^I click on "([^"]*)" for the previously added product$/
     */
    public function iClickOnForThePreviouslyAddedProduct($arg1)
    {
        $this->productManagerPage->getProdDisableEnableBtn(1)->click();
    }

    /**
     * @Given /^alert pops up regarding previous action$/
     */
    public function alertPopsUpRegardingPreviousAction()
    {

    }

    /**
     * @Given /^alert pops up regarding "([^"]*)" product$/
     */
    public function alertPopsUpRegardingProduct($action)
    {
        $alertText = $this->getSession()->getDriver()->getWebDriverSession()->getAlert_text();

        switch ($action){
            case "disabling":
                expect($alertText)->shouldBe(sprintf(SellerValues::disableAlert,SellerValues::$randProdName));
                break;
            case "enabling":
                expect($alertText)->shouldBe(sprintf(SellerValues::enableAlert,SellerValues::$randProdName));
                break;
        }
    }

    /**
     * @Then /^I accept the alert$/
     */
    public function iAcceptTheAlert()
    {
        $this->getSession()->getDriver()->getWebDriverSession()->accept_alert();
    }

    /**
     * @Then /^Enable button is present and Disable button is not for the created product$/
     */
    public function enableButtonIsPresentAndDisableButtonIsNotForTheCreatedProduct()
    {
        $btn = $this->productManagerPage->getProdDisableEnableBtn(1)->getText();
        expect($btn)->shouldBe("Enable");
    }

    /**
     * @Given /^I edit the product that is Under review$/
     */
    public function iEditTheProductThatIsUnderReview()
    {
        $this->productManagerPage->getProdNameLink(1)->click();
    }

    /**
     * @Then /^I delete the product that is under review$/
     */
    public function iDeleteTheProductThatIsUnderReview()
    {
        $this->productManagerPage->getDeleteBtn(1)->click();

        $this->getSession()->getDriver()->getWebDriverSession()->accept_alert();

        $deleteMst = $this->productManagerPage->getMsg()->getText();
        expect($deleteMst)->shouldBe(SellerValues::deleteMsg);
    }

    /**
     * @Given /^product is not found$/
     */
    public function productIsNotFound()
    {
        sleep(3);
        $product = $this->productManagerPage->getNotProdNameLink(1);
        expect($product)->shouldBe(null);
    }

    /**
     * @Then /^I edit the product price$/
     */
    public function iEditTheProductPrice()
    {
        $this->addProductPage->getUnitPriceField()->setValue(SellerValues::dummyEditedUnitPrice);
    }

    /**
     * @Then /^check that the edited price has been saved$/
     */
    public function checkThatTheEditedPriceHasBeenSaved()
    {
        $price = $this->addProductPage->getUnitPriceField()->getAttribute('value');
        expect($price)->shouldBe(SellerValues::dummyEditedUnitPrice);
    }

    /**
     * @Given /^I go to System View Menu$/
     */
    public function iGoToSystemViewMenu()
    {
        $this->homePage->getSystemViewMenu()->click();
    }


}