<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/9/2017
 * Time: 5:17 PM
 */

namespace AdminTests;


use AdminPages\AdminValues;
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use AdminPages\HomePage;
use AdminPages\OrdersPage;
use AdminPages\OrderCommunicationsPage;
use AdminPages\ProductCatalogPage;
use AdminPages\EditOrderPage;
use AdminPages\NewPoPage;
use BuyerPages\BuyerValues;
use Magento\Sales\Helper\Admin;
use SellerPages\SellerValues;
use UtilsPage\Utils;

class SalesContext extends RawMinkContext implements Context
{
    private $utils;
    private $homepage;
    private $ordersPage;
    private $editOrderPage;
    private $newPoPage;
    private $orderCommunicationsPage;

    public function __construct(
        OrderCommunicationsPage $orderCommunicationsPage,
        NewPoPage $newPoPage,
        EditOrderPage $editOrderPage,
        OrdersPage $ordersPage,
        HomePage $homePage,Utils $utils
    )
    {
        $this->orderCommunicationsPage = $orderCommunicationsPage;
        $this->newPoPage = $newPoPage;
        $this->editOrderPage = $editOrderPage;
        $this->ordersPage = $ordersPage;
        $this->homepage = $homePage;
        $this->utils = $utils;
    }

    /**
     * @When /^I go to Orders page$/
     */
    public function iGoToOrdersPage()
    {
        $this->homepage->getSalesMenu()->click();
        $this->homepage->getOrdersMenu()->click();
    }

    /**
     * @Given /^I search for the order previously created by the buyer$/
     */
    public function iSearchForTheOrderPreviouslyCreatedByTheBuyer()
    {
        $this->homepage->waitForLoadData();
        $this->ordersPage->getSearchField()->setValue(BuyerValues::$orderID);
        $this->ordersPage->getSearchBtn()->click();
    }

    /**
     * @Then /^I view the order$/
     */
    public function iViewTheOrder()
    {
        $this->homepage->waitForLoadData();
        $this->ordersPage->getViewBtn(1)->click();
    }

    /**
     * @Given /^I click on Create Po$/
     */
    public function iClickOnCreatePo()
    {
        $this->editOrderPage->getCreatePoBtn()->click();
    }

    /**
     * @Then /^I create the Po$/
     */
    public function iCreateThePo()
    {
        $this->newPoPage->getCreatePoBtn()->click();
        $msg = $this->editOrderPage->getPoCreatedMsg()->getText();
        expect($msg)->shouldBe(AdminValues::createSinglePoMsg);
    }

    /**
     * @Then /^I search for the question submitted by the seller$/
     */
    public function iSearchForTheQuestionSubmittedByTheSeller()
    {
        $this->orderCommunicationsPage->getQuestionField()->setValue(SellerValues::buyerQuestion);
        $this->orderCommunicationsPage->getSearchBtn()->click();
        $this->orderCommunicationsPage->getCommDateFilter()->click();
        $this->orderCommunicationsPage->getCommDateFilter()->click();
    }

    /**
     * @Then /^I edit the question$/
     */
    public function iEditTheQuestion()
    {
        $this->orderCommunicationsPage->getEditBtn(1)->click();
    }

    /**
     * @Given /^Question and answer are present$/
     */
    public function questionAndAnswerArePresent()
    {
        $question = $this->orderCommunicationsPage->getSellerQuestion()->getText();
        $answer = $this->orderCommunicationsPage->getBuyerAnswer()->getText();

        echo $question."\r\n";
        echo $answer."\r\n";

        expect($question)->shouldBe(SellerValues::buyerQuestion);
        expect($answer)->shouldBe(BuyerValues::buyerAnswer);
    }

    /**
     * @Then /^I approve the buyer's answer$/
     */
    public function iApproveTheBuyerSAnswer()
    {
        $this->orderCommunicationsPage->getAnswerStatusDropdown()->selectOption("Approved");
        $this->orderCommunicationsPage->getSaveBtn()->click();
    }

    /**
     * @Given /^a message is shown regarding answer approved$/
     */
    public function aMessageIsShownRegardingAnswerApproved()
    {
        $msg = $this->orderCommunicationsPage->getSuccessMsg()->getText();
        expect($msg)->shouldBe(AdminValues::communicationSavedMsg);
    }

    /**
     * @When /^I go to Sales > Order Communications menu$/
     */
    public function iGoToSalesOrderCommunicationsMenu()
    {
        $this->homepage->getSalesMenu()->click();
        $this->homepage->getOrderCommunicationsMenu()->click();
    }

    /**
     * @Then /^Seller's question has status "([^"]*)" while Buyer answer has status "([^"]*)"$/
     */
    public function sellerSQuestionHasStatusWhileBuyerAnswerHasStatus($expectedCommStatus, $expectedAnsStatus)
    {
        $comStat = $this->orderCommunicationsPage->getCommStatus(1)->getText();
        $answerStat = $this->orderCommunicationsPage->getAnswerStatus(1)->getText();

        expect($comStat)->shouldBe($expectedCommStatus);
        expect($answerStat)->shouldBe($expectedAnsStatus);
    }

    /**
     * @Then /^Buyer answer has status "([^"]*)" in edit mode$/
     */
    public function buyerAnswerHasStatusInEditMode($expectedStatus)
    {
        $foundStatus = $this->orderCommunicationsPage->getSelectedAnswerStatus()->getText();
        expect($foundStatus)->shouldBe($expectedStatus);
    }

    /**
     * @Then /^I change seller's question status to "([^"]*)"$/
     */
    public function iChangeSellerSQuestionStatusTo($status)
    {
        $this->orderCommunicationsPage->getCommStatusDropdown()->selectOption($status);
        $this->orderCommunicationsPage->getSaveBtn()->click();
    }

    /**
     * @Then /^I change buyer's answer status to "([^"]*)"$/
     */
    public function iChangeBuyerSAnswerStatusTo($status)
    {
        $this->orderCommunicationsPage->getAnswerStatusDropdown()->selectOption($status);
        $this->orderCommunicationsPage->getSaveBtn()->click();
    }


}