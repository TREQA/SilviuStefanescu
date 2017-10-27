<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 17.05.2017
 * Time: 15:14
 */

namespace BuyerTests;


use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use BuyerPages\HomePage;
use BuyerPages\ProductDetailsPage;
use BuyerPages\ListProductsPage;
use UtilsPage\DataItems;
use UtilsPage\Utils;

class BuyerRestrictionsContext extends RawMinkContext implements Context
{

    private $listProductsPage;
    private $homePage;
    private $prodDetailPage;
    private $utils;

    public function __construct(
        ListProductsPage $listProductsPage,
        HomePage $homePage,
        ProductDetailsPage $prodDetailPage,
        Utils $utils
    )
    {
        $this->listProductsPage = $listProductsPage;
        $this->homePage = $homePage;
        $this->prodDetailPage = $prodDetailPage;
        $this->utils=$utils;
    }

    /**
     * @Given /^I search for "([^"]*)";$/
     */
    public function iSearchFor($arg1)
    {
        $this->homePage->getSearchField()->setValue($arg1);
        $this->homePage->getSearchButton()->click();
    }

    /**
     * @Then /^No price is present for the product$/
     */
    public function noPriceIsPresentForTheProduct()
    {
        $this->listProductsPage->getFirstProduct();
        $price = $this->listProductsPage->getFirstProductPriceNot()->getText();
        expect($price)->shouldBe(' ');
    }

    /**
     * @Given /^Out of stock label is not shown$/
     */
    public function outOfStockLabelIsNotShown()
    {
        $stockNotAvailable = $this->listProductsPage->getFirstProdStockUnavailableNot();
        expect($stockNotAvailable)->shouldBe(null);
    }

    /**
     * @Given /^Add to cart button is not present$/
     */
    public function addToCartButtonIsNotPresent()
    {
        $stockNotAvailable = $this->listProductsPage->getFirstAddCartButtonNot();
        expect($stockNotAvailable)->shouldBe(null);
    }

    /**
     * @When /^I click on first search result$/
     */
    public function iClickOnFirstSearchResult()
    {
        $this->listProductsPage->getFirstProduct()->click();
    }

    /**
     * @Then /^Price is not shown in product details$/
     */
    public function priceIsNotShownInProductDetails()
    {
        $this->prodDetailPage->getProductName();
        $price = $this->prodDetailPage->getPriceNot();
        expect($price)->shouldBe(null);
    }

    /**
     * @Given /^Out of stock is not shown in product details$/
     */
    public function outOfStockIsNotShownInProductDetails()
    {
        $stock = $this->prodDetailPage->getOutOfStockLabelNot();
        expect($stock)->shouldBe(null);
    }

    /**
     * @Given /^Add to cart button is not present in product details$/
     */
    public function addToCartButtonIsNotPresentInProductDetails()
    {
        $cart = $this->prodDetailPage->getAddToCartButtonNot();
        expect($cart)->shouldBe(null);
    }

    /**
     * @Given /^VAt excluded is not shown in product details$/
     */
    public function vatExcludedIsNotShownInProductDetails()
    {
        $vat = $this->prodDetailPage->getVatExcludedNot();
        expect($vat)->shouldBe(null);
    }

    /**
     * @Given /^Notify me when this product is in stock option is not present$/
     */
    public function notifyMeWhenThisProductIsInStockOptionIsNotPresent()
    {
        $notify = $this->prodDetailPage->getNotifStockNot();
        expect($notify)->shouldBe(null);
    }

    /**
     * @Given /^Notify me when the price drops option is not present$/
     */
    public function notifyMeWhenThePriceDropsOptionIsNotPresent()
    {
        $notify = $this->prodDetailPage->getNotifPriceDropNot();
        expect($notify)->shouldBe(null);
    }

    /**
     * @Given /^I search for the product created by the admin$/
     */
    public function iSearchForTheProductCreatedByTheAdmin()
    {
        $this->homePage->getSearchField()->setValue(DataItems::$noPriceProdRand);
        echo DataItems::$noPriceProdRand;
        $this->homePage->getSearchButton()->click();
    }

    /**
     * @Then /^I find the product$/
     */
    public function iFindTheProduct()
    {
        $name = $this->listProductsPage->getFirstProductName()->getText();
        echo DataItems::$noPriceProdRand;
        expect($name)->shouldBe(strtoupper(DataItems::$noPriceProdRand));
    }


}