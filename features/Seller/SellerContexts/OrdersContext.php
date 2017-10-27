<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/12/2017
 * Time: 3:42 PM
 */

namespace SellerTests;


use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use BuyerPages\BuyerValues;
use SellerPages\SellerValues;
use UtilsPage\Utils;
use UtilsPage\DataItems;
use SellerPages\OrdersPage;
use SellerPages\HomePage;

class OrdersContext extends RawMinkContext implements Context
{
    private $utils;
    private $homePage;
    private $ordersPage;

    public function __construct(OrdersPage $ordersPage, HomePage $homePage,Utils $utils)
    {
        $this->ordersPage = $ordersPage;
        $this->homePage = $homePage;
        $this->utils = $utils;
    }

    /**
     * @When /^I go to Seller's Orders page$/
     */
    public function iGoToSellerSOrdersPage()
    {
        $this->homePage->getOrdersMenu()->click();
    }

    /**
     * @Then /^I search for the order with PO created$/
     */
    public function iSearchForTheOrderWithPOCreated()
    {
        $this->visitPath("https://market.int.thingpark.com/udpo/vendor/index/?submit_action=&filter_order_id_from=".BuyerValues::$orderID."&filter_order_id_to=".BuyerValues::$orderID."&apply_filter=search#");
    }

    /**
     * @Given /^The order is found in Pending Status$/
     */
    public function theOrderIsFoundInPendingStatus()
    {
        $status = $this->ordersPage->getOrderStatus(1)->getText();
        expect($status)->shouldBe("Pending");
    }

    /**
     * @Given /^The order is found in "([^"]*)" Status$/
     */
    public function theOrderIsFoundInStatus($expectedStatus)
    {
        $status = $this->ordersPage->getOrderStatus(1)->getText();
        expect($status)->shouldBe($expectedStatus);
    }

    /**
     * @Given /^Confirmation message regarding question being sent is displayed$/
     */
    public function confirmationMessageRegardingQuestionBeingSentIsDisplayed()
    {
       $msg = $this->ordersPage->getSuccMsg()->getText();
       expect($msg)->shouldBe(SellerValues::buyerQuestionSentMsg);
    }

    /**
     * @Then /^I open order information$/
     */
    public function iOpenOrderInformation()
    {
        $this->ordersPage->getOrderCollapseMenu(1)->click();
    }

    /**
     * @Given /^buyer communication section is present$/
     */
    public function buyerCommunicationSectionIsPresent()
    {
        $title = $this->ordersPage->getBuyerQuestionTitle()->getText();
        $label = $this->ordersPage->getBuyerQuestionLabel()->getText();
        $btnText = $this->ordersPage->getBuyerQuestionBtn()->getText();

        $this->ordersPage->getBuyerQuestionField()->setValue(SellerValues::buyerQuestion);

        expect($title)->shouldBe(SellerValues::buyCommTitle);
        expect($label)->shouldBe(SellerValues::buyCommLabel);
        expect($btnText)->shouldBe(SellerValues::buyCommBtnTxt);
    }

    /**
     * @Then /^I submit a question to the buyer regarding the order$/
     */
    public function iSubmitAQuestionToTheBuyerRegardingTheOrder()
    {
        $this->ordersPage->getBuyerQuestionBtn()->click();
    }

    /**
     * @Given /^I click on the first order$/
     */
    public function iClickOnTheFirstOrder()
    {
        $this->ordersPage->getFirstOrder()->click();
    }

    /**
     * @Given /^I attach Invoice to order$/
     */
    public function iAttachInvoiceToOrder()
    {
        $this->ordersPage->getBrowseFile()->attachFile("C:/Selenium/Lorem-Ipsum.pdf");
    }

    /**
     * @Then /^Attached PDF is the same as the Order Number$/
     */
    public function attachedPDFIsTheSameAsTheOrderNumber()
    {
        $orderID = $this->ordersPage->getFirstOrderOrderID()->getText();
        $pdfName = $this->ordersPage->getAttachedPdfName()->getText();
        expect($pdfName) -> shouldBe($orderID.".pdf");
    }


}