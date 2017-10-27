<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 09-May-17
 * Time: 3:07 PM
 */

namespace BuyerTests;


use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use UtilsPage\DataItems;
use UtilsPage\Utils;
use BuyerPages\CartPopupPage;
use BuyerPages\HomePage;
use BuyerPages\ProductDetailsPage;
use BuyerPages\ShoppingCartPage;
use BuyerPages\ListProductsPage;


class AnonCartContext extends RawMinkContext implements Context{

    private $listProductsPage;
    private $shoppingCartPage;
    private $cartPopUpPage;
    private $homePage;
    private $prodDetailPage;
    private $utils;

    public function __construct(
        ListProductsPage $listProductsPage,
        ShoppingCartPage $shoppingCartPage,
        CartPopupPage $cartPopupPage,
        HomePage $homePage,
        ProductDetailsPage $prodDetailPage,
        Utils $utils)
    {
        $this->listProductsPage = $listProductsPage;
        $this->shoppingCartPage = $shoppingCartPage;
        $this->cartPopUpPage = $cartPopupPage;
        $this->homePage = $homePage;
        $this->prodDetailPage = $prodDetailPage;
        $this->utils = $utils;
    }


    /**
     * @When /^I click on My Cart$/
     */
    public function iClickOnMyCart()
    {
        $this->cartPopUpPage->getMyCart()->click();
    }

    /**
     * @Then /^a message will be shown regarding no products present in the cart$/
     */

    /**
     * @Then /^the message "([^"]*)" will be shown\.$/
     */
    public function theMessageWillBeShown($arg1)
    {
        $empty = $this->cartPopUpPage->getEmptyCart();
        expect($empty->getText())->shouldBe($arg1);
    }

    /**
     * @When /^I click on a product$/
     */
    public function iClickOnAProduct()
    {
        $this->homePage->getFirstTopProduct()->click();
    }

    /**
     * @Given /^I click on add to cart$/
     */
    public function iClickOnAddToCart()
    {
        DataItems::$productPrice = $this->prodDetailPage->getPrice()->getText();
        $this->homePage->waitForJQuery();
        $this->prodDetailPage->getAddToCartButton()->click();
        $this->homePage->waitForJQuery();
        $this->homePage->getMyCartQty();
    }

    /**
     * @Then /^a number is added next to my cart based on product quantities$/
     */
    public function aNumberIsAddedNextToMyCartBasedOnProductQuantities()
    {
        $itemNo = $this->homePage->getMyCartQty()->getText();
        expect($itemNo)->shouldBe(DataItems::itemsBought);
    }

    /**
     * @Given /^a confirmation message is shown$/
     */
    public function aConfirmationMessageIsShown()
    {
        $message = sprintf(DataItems::itemAddedMessage, DataItems::$productName);
        expect($message)->shouldBe(DataItems::itemAddedMessage);
    }

    /**
     * @Given /^I see the number of items$/
     */
    public function iSeeTheNumberOfItems()
    {
        $itemNo = $this->cartPopUpPage->getItemsNo()->getText();
        expect($itemNo)->shouldBe(DataItems::itemsBoughtNo);
    }

    /**
     * @Given /^I see the Cart Subtotal$/
     */
    public function iSeeTheCartSubtotal()
    {
        $subtotalTitle = $this->cartPopUpPage->getSubtotalTitle()->getText();
        expect($subtotalTitle)->shouldBe(DataItems::subtotalTitle);
        $subtotalValue = $this->cartPopUpPage->getSubtotalValue()->getText();
        expect($subtotalValue)->shouldBe(DataItems::$productPrice);
    }

    /**
     * @Given /^I see the Go to Checkout option$/
     */
    public function iSeeTheGoToCheckoutOption()
    {
        $checkoutButtonText = $this->cartPopUpPage->getCheckoutButton()->getText();
        expect($checkoutButtonText)->shouldBe(DataItems::checkoutButton);
    }

    /**
     * @Given /^I see the Edit item button$/
     */
    public function iSeeTheEditItemButton()
    {
        $editButton = $this->cartPopUpPage->getEditButton()->getAttribute('title');
        expect($editButton)->shouldBe(DataItems::editButtonTitle);
    }

    /**
     * @Given /^I see the Delete item button$/
     */
    public function iSeeTheDeleteItemButton()
    {
        $deleteButton = $this->cartPopUpPage->getDeleteButton()->getAttribute('title');
        expect($deleteButton)->shouldBe(DataItems::deleteButtonTitle);
    }

    /**
     * @Given /^I see the View and edit card link$/
     */
    public function iSeeTheViewAndEditCardLink()
    {
        $viewEditCart = $this->cartPopUpPage->getViewCartButton()->getText();
        //$viewEditCartLink = $this->cartPopUpPage->getDeleteButton()->getAttribute('href');
        expect($viewEditCart)->shouldBe(DataItems::viewEditCart);
    }

    /**
     * @Given /^I click on View and Edit$/
     */
    public function iClickOnViewAndEdit()
    {
        $this->cartPopUpPage->getViewCartButton()->click();
    }

    /**
     * @Given /^I click on Proceed to Checkout$/
     */
    public function iClickOnProceedToCheckout()
    {
        $loadMaskCart = $this->homePage->waitForCartSummaryLoad()->getText();
        expect($loadMaskCart)->shouldBe(dataItems::cartLoadMask);
        $this->shoppingCartPage->getProceedToCheckoutBtn()->click();
    }

    /**
     * @When /^I add to cart the "([^"]*)" product$/
     */
    public function iAddToCartTheProduct($arg1)
    {

    }

    /**
     * @When /^I add to cart the "([^"]*)" product from listing page$/
     */
    public function iAddToCartTheProductFromListingPage($arg1)
    {
        $this->homePage->getSearchField()->setValue($arg1);
        $this->homePage->getSearchButton()->click();

        DataItems::$productPrice = $this->listProductsPage->getFirstProductPrice()->getText();

        $this->listProductsPage->getFirstAddCartButton()->click();
    }

}