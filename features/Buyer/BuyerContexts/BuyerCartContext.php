<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 12.05.2017
 * Time: 18:42
 */

namespace BuyerTests;


use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use BuyerPages\CartPopupPage;
use BuyerPages\HomePage;
use BuyerPages\ProductDetailsPage;
use BuyerPages\DevKitsFieldTestsPage;
use BuyerPages\ListProductsPage;
use BuyerPages\CheckoutPage;
use BuyerPages\CardPaymentPage;
use BuyerPages\BuyerValues;
use SellerPages\SellerValues;
use UtilsPage\DataItems;
use UtilsPage\Utils;

class BuyerCartContext extends RawMinkContext implements Context
{
    private $cardPaymentPage;
    private $checkoutPage;
    private $listProductsPage;
    private $cartPopUpPage;
    private $homePage;
    private $prodDetailPage;
    private $devKitsFieldTestsPage;
    private $utils;

    public function __construct(
        CardPaymentPage $cardPaymentPage,
        CheckoutPage $checkoutPage,
        ListProductsPage $listProductsPage,
        DevKitsFieldTestsPage $devKitsFieldTestsPage,
        CartPopupPage $cartPopupPage,
        HomePage $homePage,
        ProductDetailsPage $prodDetailPage,
        Utils $utils
    )
    {
        $this->cardPaymentPage = $cardPaymentPage;
        $this->checkoutPage = $checkoutPage;
        $this->listProductsPage = $listProductsPage;
        $this->cartPopUpPage = $cartPopupPage;
        $this->homePage = $homePage;
        $this->prodDetailPage = $prodDetailPage;
        $this->devKitsFieldTestsPage = $devKitsFieldTestsPage;
        $this->utils=$utils;
    }

    /**
     * @When /^I add to cart a product from Dev Kits&Field Tests menu$/
     */
    public function iAddToCartAProductFromDevKitsFieldTestsMenu()
    {
        $this->homePage->getDevicesMenuOption()->mouseOver();
        $this->homePage->getGatewaysMenuOption()->click();
        DataItems::$productName = $this->devKitsFieldTestsPage->getFirstProductName()->getText();
        DataItems::$productPrice = $this->devKitsFieldTestsPage->getFirstProductPrice()->getText();
        $this->devKitsFieldTestsPage->getFirstAddCartButton()->click();
    }

    /**
     * @Given /^A confirmation message is shown$/
     */
    public function aConfirmationMessageIsShown()
    {
        $message = sprintf(DataItems::itemAddedMessage, DataItems::$productName);
        expect($message)->shouldBe(DataItems::itemAddedMessage);
    }

    /**
     * @Given /^I see the Cart Subtotal for buyer$/
     */
    public function iSeeTheCartSubtotalForBuyer()
    {
        $subtotalTitle = $this->cartPopUpPage->getSubtotalTitle()->getText();
        expect($subtotalTitle)->shouldBe(DataItems::subtotalTitle);

        $subtotalValue = $this->cartPopUpPage->getSubtotalValue()->getText();
//        $subtotalInt = filter_var($subtotalValue, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
//        echo $subtotalInt;

        expect($subtotalValue)->shouldBe(DataItems::$productPrice); //refactor this
    }

    /**
     * @Given /^I have an empty Cart$/
     */
    public function iHaveAnEmptyCart()
    {
        sleep(3);
        $this->cartPopUpPage->emptyCart();
    }

    /**
     * @When /^I search for the advanced pricing product$/
     */
    public function iSearchForTheAdvancedPricingProduct()
    {
        $this->homePage->getSearchField()->setValue(SellerValues::$randProdName);
        $this->homePage->getSearchButton()->click();
    }

    /**
     * @When /^I search for an advanced pricing product$/
     */
    public function iSearchForAnAdvancedPricingProduct()
    {
        $this->homePage->getSearchField()->setValue(SellerValues::dummyAdvDeviceProduct);
        $this->homePage->getSearchButton()->click();
    }

    /**
     * @Then /^I see the advanced pricing information$/
     */
    public function iSeeTheAdvancedPricingInformation()
    {
        $oldPrice = $this->listProductsPage->getOldPriceOffer()->getText();
        $old = filter_var($oldPrice, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
        expect($old)->shouldBe(SellerValues::dummyUnitPrice);

        $specialPrice = $this->listProductsPage->getFirstProdSpecialPrice()->getText();
        $special = filter_var($specialPrice, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
        expect($special)->shouldBe(SellerValues::advPriceDef);

        $lowestPrice = $this->listProductsPage->getFirstProdLowestPrice()->getText();
        $lowest = filter_var($lowestPrice, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

        expect($lowest)->shouldBe(SellerValues::advPriceThree);


        $this->listProductsPage->getFirstProdLowestPrice()->mouseOver();
        $allOff = $this->listProductsPage->getFirstProdMinPriceOff2()->getText();

        expect($allOff)->shouldBe(SellerValues::advPriceOffers);
    }

    /**
     * @Then /^I see the detailed advanced pricing information$/
     */
    public function iSeeTheDetailedAdvancedPricingInformation()
    {
        $oldOffer = $this->prodDetailPage->getOldPriceOffer()->getText();
        $old = filter_var($oldOffer, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
        expect($old)->shouldBe(SellerValues::dummyUnitPrice);


        $specialOffer = $this->prodDetailPage->getSpecialPriceOffer()->getText();
        $offer = filter_var($specialOffer, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
        expect($offer)->shouldBe(SellerValues::advPriceDef);

        $advPrice1  = $this->prodDetailPage->getAdvancedPricingOffer(1)->getText();
        $advPrice2  = $this->prodDetailPage->getAdvancedPricingOffer(2)->getText();
        $advPrice3  = $this->prodDetailPage->getAdvancedPricingOffer(3)->getText();

        expect($advPrice1)->shouldBe(SellerValues::offer1);
        expect($advPrice2)->shouldBe(SellerValues::offer2);
        expect($advPrice3)->shouldBe(SellerValues::offer3);


    }

    /**
     * @Given /^I click on Next$/
     */
    public function iClickOnNext()
    {
        $this->checkoutPage->waitForLoad();
        $this->checkoutPage->getNextButton()->click();
    }

    /**
     * @Then /^I select the payment method$/
     */
    public function iSelectThePaymentMethod()
    {
        $this->utils->waitUntilElementVisible(DataItems::waitTime,"xpath","//*[@id='hipay_direct']");
        $this->checkoutPage->getCreditCardRadioBtn()->click();
    }

    /**
     * @Given /^I agree to the terms and conditions for the seller and ThinkPark$/
     */
    public function iAgreeToTheTermsAndConditionsForTheSellerAndThinkPark()
    {
        $this->checkoutPage->getSellerTcCheckBox()->check();
        $this->checkoutPage->getBillAgreeCheckBox()->check();
        $this->checkoutPage->getThinkParkTcHiPayCheckBox()->check();
    }

    /**
     * @Then /^I click on "([^"]*)"$/
     */
    public function iClickOn($btnText)
    {
        $this->checkoutPage->getPayPlaceOrdBtn($btnText)->click();
    }

    /**
     * @Given /^I complete my "([^"]*)" credit card details$/
     */
    public function iCompleteMyCreditCardDetails($cardType)
    {
        switch ($cardType){
            case "VISA":
                $this->cardPaymentPage->getCardVisa()->click();
                break;
            case "CB":
                $this->cardPaymentPage->getCardCb()->click();
                break;
            case "MASTER":
                $this->cardPaymentPage->getCardMaster()->click();
                break;
            case "MAESTRO":
                $this->cardPaymentPage->getCardMaestro()->click();
                break;
        }

        $this->cardPaymentPage->getCardNoField()->setValue(BuyerValues::validVisaCardNo);
        $this->cardPaymentPage->getCardHolderField()->setValue(BuyerValues::validCardHolderName);
        $this->cardPaymentPage->getExpDateMonthDropdown()->selectOption(BuyerValues::validCardExpDateMonth);
        $this->cardPaymentPage->getExpDateYearDropdown()->selectOption(BuyerValues::validCardExpDateYear);
        $this->cardPaymentPage->getCvvField()->setValue(BuyerValues::validCardCvv);
    }



    /**
     * @Then /^I click on pay$/
     */
    public function iClickOnPay()
    {
        $this->cardPaymentPage->getPayBtn()->click();
    }

    /**
     * @Given /^payment is successful$/
     */
    public function paymentIsSuccessful()
    {
        //$this->cardPaymentPage->getProcessPayMsg();
        //$this->cardPaymentPage->getPaySuccessMsg();
        $message = $this->checkoutPage->getPaySucessMsg()->getText();

        expect($message)->shouldBe(BuyerValues::paymentPendingMsg);
        BuyerValues::$orderID = $this->checkoutPage->getOrderID()->getText();
    }

    /**
     * @Then /^I chose to pay via Credit Card$/
     */
    public function iChoseToPayViaCreditCard()
    {
        $this->checkoutPage->waitForLoad();
        $this->checkoutPage->getCreditCardRadioBtn()->click();
    }

    /**
     * @Then /^I chose to pay via Bank Transfer Payment$/
     */
    public function iChoseToPayViaBankTransferPayment()
    {
        $this->homePage->waitForLoad();
        $this->checkoutPage->getBankTransferRadioBtn()->click();
    }

    /**
     * @Given /^I agree on the terms and conditions for the seller and ThinkPark$/
     */
    public function iAgreeOnTheTermsAndConditionsForTheSellerAndThinkPark()
    {
        $this->checkoutPage->getSellerTcCheckBox()->check();
        $this->checkoutPage->getThinkParkTcBankTransferCheckBox()->check();
    }

    /**
     * @Given /^Order has been placed successfully$/
     */
    public function orderHasBeenPlacedSuccessfully()
    {
        $msg = $this->checkoutPage->getOrderPlacedEmailMsg()->getText();
        expect($msg)->shouldBe(BuyerValues::orderPlacedMsg);
        BuyerValues::$orderID = $this->checkoutPage->getOrderID()->getText();
    }


}