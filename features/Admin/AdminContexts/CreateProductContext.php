<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 16.05.2017
 * Time: 15:26
 */

namespace AdminTests;


use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use UtilsPage\Utils;
use UtilsPage\DataItems;
use SellerPages\SellerValues;
use AdminPages\HomePage;
use AdminPages\AddProductPage;
use AdminPages\ProductCatalogPage;
use AdminPages\AdminValues;


class CreateProductContext extends RawMinkContext implements Context
{
    private $utils;
    private $homepage;
    private $productCatalogPage;
    private $addProductPage;

    public function __construct(AddProductPage $addProductPage,ProductCatalogPage $productCatalogPage,HomePage $homePage,Utils $utils)
    {
        $this->addProductPage= $addProductPage;
        $this->productCatalogPage = $productCatalogPage;
        $this->homepage = $homePage;
        $this->utils = $utils;
    }

    /**
     * @Given /^I go to Products Catalog page$/
     */
    public function iGoToProductsCatalogPage()
    {
        $this->homepage->getProductMenu()->click();
        $this->homepage->getCatalogMenu()->click();
    }

    /**
     * @Given /^I click on Add > Product \- No price button$/
     */
    public function iClickOnAddProductNoPriceButton()
    {
        $this->productCatalogPage->getAddProdOptionsButton()->click();
        $this->productCatalogPage->getProdNoPriceButton()->click();
    }

    /**
     * @Then /^Unit Price field is not present$/
     */
    public function unitPriceFieldIsNotPresent()
    {
        //used to wait for page to load
        $loaded = $this->homepage->waitForLoad();
        expect($loaded)->shouldBe(true);

        $priceLabe = $this->addProductPage->getUnitPriceLabel();
        expect($priceLabe)->shouldBe(null);
    }

    /**
     * @Given /^Main Website box is checked$/
     */
    public function mainWebsiteBoxIsChecked()
    {
        $loaded = $this->homepage->waitForLoad();
        expect($loaded)->shouldBe(true);

        $this->addProductPage->getProdInWebsite()->click();
        $boxStatus = $this->addProductPage->getMainWebSiteCheckbox()->isChecked();
        expect($boxStatus)->shouldBe(true);
    }

    /**
     * @Then /^I complete all mandatory fields for no price product$/
     */
    public function iCompleteAllMandatoryFieldsForNoPriceProduct()
    {
        $random = $this->utils->randomInt();
        DataItems::$noPriceProdRand = DataItems::noPriceProd.$random;
        $this->addProductPage->getProductNameField()->setValue(DataItems::$noPriceProdRand);
    }

    /**
     * @Given /^I click on Save button$/
     */
    public function iClickOnSaveButton()
    {
        $this->addProductPage->getSaveButton()->click();
    }

    /**
     * @Then /^Product is created and no errors are shown$/
     */
    public function productIsCreatedAndNoErrorsAreShown()
    {
        //$this->homepage->waitForLoad();

        $message = $this->addProductPage->getPageMessage()->getText();
        expect($message)->shouldBe(DataItems::productSaveMsg);

        $this->homepage->waitForLoad();
        $this->homepage->getProductMenu()->click();
        $this->homepage->getCatalogMenu()->click();

        $this->homepage->waitForLoadData();
        $this->productCatalogPage->getFilterBtn()->click();

        $this->productCatalogPage->getNameFilterField()->setValue(DataItems::$noPriceProdRand);
        $this->productCatalogPage->getApplyFilterBtn()->click();

        $name = $this->productCatalogPage->getProdName(1,DataItems::$noPriceProdRand)->getText();
        $price = $this->productCatalogPage->getProdPrice(1)->getText();
        expect($name)->shouldBe(DataItems::$noPriceProdRand);
        expect($price)->shouldBe("");
    }

    /**
     * @Given /^Product is saved$/
     */
    public function productIsSaved()
    {
        $this->homepage->waitForJQuery();

        $message = $this->addProductPage->getPageMessage()->getText();
        expect($message)->shouldBe(DataItems::productSaveMsg);
    }

    /**
     * @Given /^I click on add product$/
     */
    public function iClickOnAddProduct()
    {
        $this->productCatalogPage->getAddProdDefault()->click();
    }

    /**
     * @Given /^I create a product for the previously created vendor$/
     */
    public function iCreateAProductForThePreviouslyCreatedVendor()
    {
        $random = $this->utils->randomInt();
        DataItems::$noPriceProdRand = DataItems::noPriceProd.$random;
        $this->addProductPage->getProductNameField()->setValue(DataItems::$noPriceProdRand);
        $this->addProductPage->getProductPriceField()->setValue("100");
        $this->addProductPage->getDropShipVendorField()->selectOption(DataItems::$vendRandName);

        $this->addProductPage->getSaveButton()->click();
        sleep(10);
        $this->homepage->waitForLoad();
    }

    /**
     * @Given /^I create a product with (\d+) categories and (\d+) subcategories$/
     */
    public function iCreateAProductWithCategoriesAndSubcategories($arg1, $arg2)
    {
        $random = $this->utils->randomInt();
        DataItems::$noPriceProdRand = DataItems::noPriceProd.$random;
        $this->addProductPage->getProductNameField()->setValue(DataItems::$noPriceProdRand);
        $this->addProductPage->getProductPriceField()->setValue("100");
        $this->addProductPage->getDropShipVendorField()->selectOption(DataItems::$vendRandName);

        $this->addProductPage->getSaveButton()->click();
        $this->homepage->waitForLoad();
    }

    /**
     * @Then /^Price is not shown for the product$/
     */
    public function priceIsNotShownForTheProduct()
    {
        $this->homepage->waitForLoad();
        $priceField = $this->getSession()->getPage()->find("xpath","//*[@name='product[price]']");
        expect($priceField)->shouldBe(null);
    }

    /**
     * @Given /^I edit the product created by the seller$/
     */
    public function iEditTheProductCreatedByTheSeller()
    {
        $this->homepage->waitForLoadData();

        $this->productCatalogPage->getFilterBtn()->click();
        $this->productCatalogPage->getNameFilterField()->setValue(SellerValues::$randProdName);
        $this->productCatalogPage->getApplyFilterBtn()->click();

        $status = $this->productCatalogPage->getProdStatus(1,SellerValues::$randProdName)->getText();
        expect($status)->shouldBe("Pending");

        $this->productCatalogPage->getProdName(1,SellerValues::$randProdName)->click();
    }

    /**
     * @Given /^the product status is disabled$/
     */
    public function theProductStatusIsDisabled()
    {
        $off = $this->addProductPage->getEnableProductSwitchValue()->getAttribute('value');
        expect($off)->shouldBe("3");
    }

    /**
     * @Then /^I change the product status to enabled and save$/
     */
    public function iChangeTheProductStatusToEnabledAndSave()
    {
        $this->homepage->waitForLoad();

        $this->addProductPage->getEnableProductSwitchClickable()->click();
        $this->addProductPage->getSaveButton()->click();

        $this->homepage->waitForLoad();

        $message = $this->addProductPage->getPageMessage()->getText();
        expect($message)->shouldBe(DataItems::productSaveMsg);
    }

    /**
     * @Given /^product is now enabled$/
     */
    public function productIsNowEnabled()
    {
        $this->homepage->waitForLoad();

        $this->homepage->getProductMenu()->click();
        $this->homepage->getCatalogMenu()->click();

        $this->homepage->waitForLoadData();

        $this->productCatalogPage->getFilterBtn()->click();
        $this->productCatalogPage->getNameFilterField()->setValue(SellerValues::$randProdName);
        $this->productCatalogPage->getApplyFilterBtn()->click();

        $status = $this->productCatalogPage->getProdStatus(1,SellerValues::$randProdName)->getText();
        expect($status)->shouldBe("Enabled");
    }

    /**
     * @Given /^I search for the previously added product by seller$/
     */
    public function iSearchForThePreviouslyAddedProductBySeller()
    {
        $this->homepage->waitForLoadData();
        $this->productCatalogPage->getFilterBtn()->click();
        $this->productCatalogPage->getNameFilterField()->setValue(SellerValues::$randProdName);
        $this->productCatalogPage->getApplyFilterBtn()->click();
    }

    /**
     * @Then /^the product will have no price$/
     */
    public function theProductWillHaveNoPrice()
    {
        $prodName = $this->productCatalogPage->getProdName(1,SellerValues::$randProdName)->getText();
        expect($prodName)->shouldBe(SellerValues::$randProdName);
        $price = $this->productCatalogPage->getProdPrice(1)->getText();
        expect($price)->shouldBe("");
    }

    /**
     * @Given /^I edit the product$/
     */
    public function iEditTheProduct()
    {
        $this->productCatalogPage->getProdName(1,SellerValues::$randProdName)->click();
    }

    /**
     * @Then /^I click on Advanced Pricing$/
     */
    public function iClickOnAdvancedPricing()
    {
        $this->addProductPage->getAdvancedPricingBtn()->click();
    }

    /**
     * @Given /^all the advanced pricing settings are setup properly$/
     */
    public function allTheAdvancedPricingSettingsAreSetupProperly()
    {

        $price4 = $this->addProductPage->getAdvPriceField(1)->getValue();
        $qty4 = $this->addProductPage->getAdvPriceQtyField(1)->getValue();

        $price1 = $this->addProductPage->getAdvPriceField(2)->getValue();
        $qty1 = $this->addProductPage->getAdvPriceQtyField(2)->getValue();

        $price2 = $this->addProductPage->getAdvPriceField(3)->getValue();
        $qty2 = $this->addProductPage->getAdvPriceQtyField(3)->getValue();

        $price3 = $this->addProductPage->getAdvPriceField(4)->getValue();
        $qty3 = $this->addProductPage->getAdvPriceQtyField(4)->getValue();

        expect($price1)->shouldBe(SellerValues::advPriceOne);
        expect($qty1)->shouldBe(SellerValues::advPriceQtyOne);

        expect($price2)->shouldBe(SellerValues::advPriceTwo);
        expect($qty2)->shouldBe(SellerValues::advPriceQtyTwo);

        expect($price3)->shouldBe(SellerValues::advPriceThree);
        expect($qty3)->shouldBe(SellerValues::advPriceQtyThree);

        expect($price4)->shouldBe(SellerValues::advPriceDef);
        expect($qty4)->shouldBe(SellerValues::advPriceQtyDef);
    }

    /**
     * @Then /^I close the pop\-up$/
     */
    public function iCloseThePopUp()
    {
        $this->addProductPage->getAdvPriceDoneBtn()->click();
    }

    /**
     * @Then /^I set all the mandatory fields for the product$/
     */
    public function iSetAllTheMandatoryFieldsForTheProduct()
    {
        AdminValues::$randProdName = $this->utils->randomInt().AdminValues::categProd;
        $this->addProductPage->getProductNameField()->setValue(AdminValues::$randProdName);
        $this->addProductPage->getProductPriceField()->setValue("100");
    }

    /**
     * @Given /^I click on Content Section$/
     */
    public function iClickOnContentSection()
    {
        $this->homepage->waitForLoad();
        $this->addProductPage->getContentSection()->click();
    }

    /**
     * @Given /^I select "([^"]*)" Attribute Set and click on Content Section$/
     */
    public function iSelectAttributeSetAndClickOnContentSection($arg1)
    {
        $this->addProductPage->setAttrSet($arg1);
        $this->homepage->waitForJQuery();
    }

    /**
     * @Given /^I select the Product Attributes and Solutions Represented$/
     */
    public function iSelectTheProductAttributesAndSolutionsRepresented()
    {
        $this->addProductPage->getContentSection()->click();
        $this->addProductPage->getProdAttributesSelect()->selectOption("Dev kit", true);
        $this->addProductPage->getProdAttributesSelect()->selectOption("Geolocation", true);
        $this->addProductPage->getProdSolutionsSelect()->selectOption("Smart Agriculture",true);
        $this->addProductPage->getProdSolutionsSelect()->selectOption("Energy and Utilities",true);
    }

    /**
     * @Then /^Categories are added based on the selected Product Attributes and Solutions Represented$/
     */
    public function categoriesAreAddedBasedOnTheSelectedProductAttributesAndSolutionsRepresented()
    {
        $categ = $this->addProductPage->getProductCategory()->getText();
        expect($categ)->shouldBe(AdminValues::categories);
    }

    /**
     * @Given /^I edit the product with attributes created by the seller$/
     */
    public function iEditTheProductWithAttributesCreatedByTheSeller()
    {
        $this->homepage->waitForLoadData();

        $this->productCatalogPage->getFilterBtn()->click();
        $this->productCatalogPage->getNameFilterField()->setValue(AdminValues::$randProdName);
        $this->productCatalogPage->getApplyFilterBtn()->click();

        $status = $this->productCatalogPage->getProdStatus(1,AdminValues::$randProdName)->getText();
        expect($status)->shouldBe("Pending");

        $this->productCatalogPage->getProdName(1)->click();
    }

    /**
     * @Then /^the product status is "([^"]*)"$/
     */
    public function theProductStatusIs($expectedStatus)
    {
        $foundStatus = $this->productCatalogPage->getProdStatus(1,SellerValues::$randProdName)->getText();

        expect($foundStatus)->shouldBe($expectedStatus);
    }

    /**
     * @Given /^I click on Add Product Options$/
     */
    public function iClickOnAddProductOptions()
    {
        $this->productCatalogPage->getAddProdOptionsButton()->click();
    }

    /**
     * @Then /^I should see all options from Add Product Options from system view$/
     */
    public function iShouldSeeAllOptionsFromAddProductOptionsFromSystemView()
    {
        $this->productCatalogPage->checkProductTypeLabel(AdminValues::addProductTypes);
    }

    /**
     * @Given /^I search for "([^"]*)" product type$/
     */
    public function iSearchForProductType($arg1)
    {
        $this->homepage->waitForLoadData();
        $this->productCatalogPage->getFilterBtn()->click();
        $this->productCatalogPage->getAttributeSetFilterBtn()->selectOption($arg1);
        $this->productCatalogPage->getApplyFilterBtn()->click();
    }

    /**
     * @Then /^I click the first product in the list$/
     */
    public function iClickTheFirstProductInTheList()
    {
        $this->homepage->waitForLoadData();
        $this->productCatalogPage->getProductRow(1)->click();
    }

    /**
     * @Then /^ThingPark Connected option is not available$/
     */
    public function thingparkConnectedOptionIsNotAvailable()
    {
        $notPresent = $this->productCatalogPage->getSession()->getPage()->find("xpath","//*[@class='admin__field' and @data-index='ac_thingpark_approve']");
        expect($notPresent)->shouldBe(null);
    }

}