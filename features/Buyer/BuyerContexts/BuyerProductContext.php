<?php


namespace BuyerTests;


use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use BuyerPages\CartPopupPage;
use BuyerPages\HomePage;
use BuyerPages\ProductDetailsPage;
use BuyerPages\DevKitsFieldTestsPage;
use BuyerPages\ListProductsPage;
use BuyerPages\BuyerValues;
use AdminPages\AdminValues;
use SellerPages\SellerValues;
use UtilsPage\DataItems;
use UtilsPage\Utils;

class BuyerProductContext extends RawMinkContext implements Context
{
    private $listProductsPage;
    private $cartPopUpPage;
    private $homePage;
    private $prodDetailPage;
    private $devKitsFieldTestsPage;
    private $utils;

    public function __construct(
        ListProductsPage $listProductsPage,
        DevKitsFieldTestsPage $devKitsFieldTestsPage,
        CartPopupPage $cartPopupPage,
        HomePage $homePage,
        ProductDetailsPage $prodDetailPage,
        Utils $utils
    )
    {
        $this->listProductsPage = $listProductsPage;
        $this->cartPopUpPage = $cartPopupPage;
        $this->homePage = $homePage;
        $this->prodDetailPage = $prodDetailPage;
        $this->devKitsFieldTestsPage = $devKitsFieldTestsPage;
        $this->utils=$utils;
    }

    /**
     * @Given /^I search for the product with the specific attributes created by the admin$/
     */
    public function iSearchForTheProductWithTheSpecificAttributesCreatedByTheAdmin()
    {
        $this->homePage->getSearchField()->setValue(AdminValues::$randProdName);
        $this->homePage->getSearchButton()->click();
    }

    /**
     * @Then /^the product details URL has proper format$/
     */
    public function theProductDetailsURLHasProperFormat()
    {
        $url = $this->getSession()->getCurrentUrl();
        echo "found   : ".$url."\r\n";
        $urlExpected = DataItems::path.BuyerValues::categ1.BuyerValues::sub1Categ1.strtolower(AdminValues::$randProdName);
        echo "expected: ".$urlExpected;
        expect($url)->shouldBe($urlExpected);
    }

    /**
     * @Then /^the product details URL has proper format when added by seller$/
     */
    public function theProductDetailsURLHasProperFormatWhenAddedBySeller()
    {
        $url = $this->getSession()->getCurrentUrl();
        echo "found   : ".$url."\r\n";
        $urlExpected = DataItems::path.BuyerValues::categ1.BuyerValues::sub1Categ1.strtolower(SellerValues::$randProdName);
        echo "expected: ".$urlExpected;
        expect($url)->shouldBe($urlExpected);
    }

    /**
     * @When /^I search for the product with the specific attributes created by the seller$/
     */
    public function iSearchForTheProductWithTheSpecificAttributesCreatedByTheSeller()
    {
        $this->homePage->getSearchField()->setValue(SellerValues::$randProdName);
        $this->homePage->getSearchButton()->click();
    }

    /**
     * @When /^I search for the "([^"]*)" product$/
     */
    public function iSearchForTheProduct($arg1)
    {
        $this->homePage->getSearchField()->setValue(SellerValues::$randProdName);
        $this->homePage->getSearchButton()->click();
    }

    /**
     * @Then /^No results are found$/
     */
    public function noResultsAreFound()
    {
        $msg = $this->listProductsPage->getNoResultsMsg()->getText();
        echo $msg;
        expect($msg)->shouldBe(BuyerValues::noResMsg);
    }

    /**
     * @Then /^Product is found$/
     */
    public function productIsFound()
    {
       $name = $this->listProductsPage->getFirstProductName()->getText();
       expect($name)->shouldBe(strtoupper(SellerValues::$randProdName));
    }

    /**
     * @Given /^I search for the previously added product from system view$/
     */
    public function iSearchForThePreviouslyAddedProductFromSystemView()
    {
        $this->homePage->getSearchField()->setValue(AdminValues::$randProdName);
        $this->homePage->getSearchButton()->click();
    }

    /**
     * @Then /^Product from system view is found$/
     */
    public function productFromSystemViewIsFound()
    {
        $name = $this->listProductsPage->getFirstProductName()->getText();
        expect($name)->shouldBe(strtoupper(AdminValues::$randProdName));
    }


}