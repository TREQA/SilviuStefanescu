<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/13/2017
 * Time: 3:25 PM
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
use BuyerPages\MyAccountPage;
use BuyerPages\OrderMessagesPage;
use BuyerPages\BuyerValues;
use SellerPages\SellerValues;
use UtilsPage\DataItems;
use UtilsPage\Utils;

class BuyerOrdersContext extends RawMinkContext implements Context
{
    private $orderMessagesPage;
    private $myAccountPage;
    private $cardPaymentPage;
    private $checkoutPage;
    private $listProductsPage;
    private $cartPopUpPage;
    private $homePage;
    private $prodDetailPage;
    private $devKitsFieldTestsPage;
    private $utils;

    public function __construct(
        OrderMessagesPage $orderMessagesPage,
        MyAccountPage $myAccountPage,
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
        $this->orderMessagesPage = $orderMessagesPage;
        $this->myAccountPage = $myAccountPage;
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
     * @When /^I go to My Account > Orders$/
     */
    public function iGoToMyAccountOrders()
    {

    }

    /**
     * @When /^I go to My Account > Orders Messages$/
     */
    public function iGoToMyAccountOrdersMessages()
    {
        $this->homePage->getMyAccountButton()->click();
        $this->myAccountPage->getOrderMessagesMenu()->click();
    }

    /**
     * @Then /^seller's question is present$/
     */
    public function sellerSQuestionIsPresent()
    {
        $question = $this->orderMessagesPage->getOrderQuestion(BuyerValues::$orderID)->getText();
        expect($question)->shouldBe(SellerValues::buyerQuestion);
    }

    /**
     * @Given /^I click on view and submit my answer$/
     */
    public function iClickOnViewAndSubmitMyAnswer()
    {
        $this->orderMessagesPage->viewQuestion(BuyerValues::$orderID)->click();
        $question = $this->orderMessagesPage->getViewedQuestion()->getText();
        expect($question)->shouldBe(SellerValues::buyerQuestion);

        $this->orderMessagesPage->getAnswerField()->setValue(BuyerValues::buyerAnswer);
        $this->orderMessagesPage->getSubmitAnswerBtn()->click();
    }

    /**
     * @Then /^a message regarding answer being submitted is shown$/
     */
    public function aMessageRegardingAnswerBeingSubmittedIsShown()
    {
        $msg = $this->orderMessagesPage->getSuccessMessage()->getText();
        expect($msg)->shouldBe(BuyerValues::answerSubmittedMsg);
    }

    /**
     * @Given /^the page contains all the necessary information$/
     */
    public function thePageContainsAllTheNecessaryInformation()
    {
        $detail = $this->orderMessagesPage->getDetailsLabel()->getText();
        $ordMsgLabel = $this->orderMessagesPage->getOrdQuestionLabel()->getText();
        $answerMsgLabel = $this->orderMessagesPage->getOrdAnswerLabel()->getText();
        $msgDateLabel = $this->orderMessagesPage->getOrdQuestionDateLabel()->getText();
        $ansDateLabel = $this->orderMessagesPage->getOrdAnswerDateLabel()->getText();
        $ordIdLabel = $this->orderMessagesPage->getOrdIdLabel()->getText();

        expect($detail)->shouldBe("Details");
        expect($ordMsgLabel)->shouldBe("Order Message Text");
        expect($answerMsgLabel)->shouldBe("Answer Text");
        expect($msgDateLabel)->shouldBe("MESSAGE DATE");
        expect($ansDateLabel)->shouldBe("ANSWER DATE");
        expect($ordIdLabel)->shouldBe("ORDER");
    }

    /**
     * @Then /^answer is present under answer column$/
     */
    public function answerIsPresentUnderAnswerColumn()
    {
        $answ = $this->orderMessagesPage->getOrderAnswer(BuyerValues::$orderID)->getText();
        expect($answ)->shouldBe(BuyerValues::buyerAnswer);
    }


}