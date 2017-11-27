<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 11-May-17
 * Time: 4:37 PM
 */

namespace BuyerTests;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use BuyerPages\CreateNewAccPage;
use BuyerPages\LoginPage;
use BuyerPages\MyAccountPage;
use UtilsPage\DataItems;
use BuyerPages\HomePage;
use BuyerPages\ProductDetailsPage;
use BuyerPages\CartPopupPage;
use BuyerPages\ShoppingCartPage;
use BuyerPages\ListProductsPage;
use UtilsPage\Utils;

class AnonRestrictionsContext extends RawMinkContext implements Context
{

    private $homePage;
    private $myAccountPage;
    private $createNewAccPage;
    private $utils;
    private $loginPage;
    private $detailsPage;
    private $cartPopupPage;
    private $shoppingCartPage;
    private $listProductsPage;

    public function __construct(
        ListProductsPage $listProductsPage,
        ShoppingCartPage $shoppingCartPage,
        CartPopupPage $cartPopupPage,
        ProductDetailsPage $detailsPage,
        LoginPage $loginPage,
        HomePage $homePage,
        MyAccountPage $myAccountPage,
        CreateNewAccPage $createNewAccPage,
        Utils $utils
    )
    {
        $this->utils = $utils;
        $this->homePage = $homePage;
        $this->detailsPage = $detailsPage;
        $this->loginPage = $loginPage;
        $this->myAccountPage = $myAccountPage;
        $this->createNewAccPage = $createNewAccPage;
        $this->cartPopupPage = $cartPopupPage;
        $this->shoppingCartPage = $shoppingCartPage;
        $this->listProductsPage = $listProductsPage;
    }

    
       
    
    /**
     * @Then /^I am prompted to login or Create a new account$/
     */
    public function iAmPromptedToLoginOrCreateANewAccount()
    {
        $title = $this->loginPage->getTitle()->getText();
        expect($title)->shouldBe(DataItems::loginPageTitle);
        $this->loginPage->getEmailField();
        $this->loginPage->getPasswordField();
        expect($this->loginPage->getSignInButton()->getText())->shouldBe(DataItems::buyerSignIn);
        expect($this ->loginPage->getCreateAccButton()->getText())->shouldBe(DataItems::buyerCreateAcc);
    }

    /**
     * @Given /^I add it to favorite$/
     */
    public function iAddItToFavorite()
    {
        $this->detailsPage->getFavoriteButton()->click();
    }

    /**
     * @Given /^I click on Go to Checkout button$/
     */
    public function iClickOnGoToCheckoutButton()
    {
        $this->cartPopupPage->getCheckoutButton()->click();
    }

    /**
     * @Then /^I am prompted to checkout as a new customer or checkout using an existing account$/
     */
    public function iAmPromptedToCheckoutAsANewCustomerOrCheckoutUsingAnExistingAccount()
    {
        $checkoutExisting = $this->loginPage->getCheckoutPopupTitle()->getText();
        expect($checkoutExisting)->shouldBe(DataItems::checkoutExisting);
        $checkoutNew = $this->loginPage->getCheckoutNewPopupTitle()->getText();
        expect($checkoutNew)->shouldBe(DataItems::checkoutNew);
        $this->loginPage->getEmailField();
        $this->loginPage->getPasswordField();
        expect($this->loginPage->getSignInButton()->getText())->shouldBe(DataItems::buyerSignIn);
        expect($this ->loginPage->getCreateAccButtonPopUp()->getText())->shouldBe(DataItems::buyerCreateAcc);
    }

    /**
     * @Given /^I add to wish list one of the top products$/
     */
    public function iAddToWishListOneOfTheTopProducts()
    {
        $this->homePage->getFirstTopProduct()->mouseOver();
        $this->homePage->getFirstTopProductFavorite()->click();
    }

    /**
     * @Given /^I click on technical doc pdf link$/
     */
    public function iClickOnTechnicalDocPdfLink()
    {
        $pdfTableTitle = $this->detailsPage->getPDFTableTitle()->getText();
        expect($pdfTableTitle)->shouldBe(DataItems::pdfTableTitle);
        $this->detailsPage->getFirstPDFlink()->click();
    }

    /**
     * @Then /^A pop\-up appears to login or Create a new account in order to view content$/
     */
    public function aPopUpAppearsToLoginOrCreateANewAccountInOrderToViewContent()
    {
        $this->homePage->waitForJQuery();
        $title = $this->loginPage->getRegCustomerCanAccPopup()->getText();
        expect($title)->shouldBe(DataItems::createAccPopUpContent);
    }

    /**
     * @Given /^I add to wishlist the "([^"]*)" product from listing page$/
     */
    public function iAddToWishlistTheProductFromListingPage($arg1)
    {
        $this->homePage->getSearchField()->setValue($arg1);
        $this->homePage->getSearchButton()->click();

        $this->listProductsPage->getFirstAddCartButton()->mouseOver();
        $this->listProductsPage->getFirstAddWishlistButton()->click();
    }



}