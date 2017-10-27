<?php

namespace CommonTests;
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use BuyerPages\MyAccountPage;
use BuyerPages\HomePage;
use UtilsPage\Utils;
use UtilsPage\DataItems;

/**
 * Defines application features from the specific context.
 */
class LoginContext extends RawMinkContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */

    private $myAccountPage;
    private $utils;
    private $homePage;


    public function __construct(MyAccountPage $myAccountPage, Utils $utils, HomePage $homePage)
    {
        $this->myAccountPage = $myAccountPage;
        $this->utils=$utils;
        $this->homePage=$homePage;
    }

    /**
     * @Given /^I am a "([^"]*)" and I write in my username "([^"]*)" and password "([^"]*)"$/
     */
    public function iAmAAndIWriteInMyUsernameAndPassword($userType, $username, $password)
    {
        switch($userType){
            case "admin":
                echo "Logging in as".$userType;
                $this->visitPath("admin45458/");
                $this->getSession()->getPage()->fillField('username',$username);
                $this->getSession()->getPage()->fillField('login',$password);
                $this->utils->findElement('xpath','//*[@id="login-form"]/fieldset/div[3]/div[1]/button')->click();
                break;
            case "seller":
                echo "Logging in as".$userType;
                $this->visitPath("udropship/vendor/");
                $this->getSession()->getPage()->fillField('email',$username);
                $this->getSession()->getPage()->fillField('pass',$password);
                $this->utils->findElement('xpath','//*[@id="login-form"]/div/div[3]/button')->click();
                break;
            case "buyer":
                echo "Logging in as".$userType;
                $this->visitPath("/customer/account/login/");
                $this->getSession()->getPage()->fillField('email',$username);
                $this->getSession()->getPage()->fillField('pass',$password);
                $this->utils->findElement("xpath","//*[@id='send2']")->click();
                break;
        }
    }

    /**
     * @Given /^I am logged in as "([^"]*)"$/
     */
    public function iAmLoggedInAs($userType)
    {
        switch($userType){
            case "admin":
                echo "Logging in as ".$userType;
                $this->visitPath("admin45458/");
                $this->getSession()->maximizeWindow();
                $this->utils->waitUntilElementPresent(DataItems::waitTime,'xpath',"//*[@id='username']")->setValue(DataItems::adminMail);
                $this->getSession()->getPage()->fillField('login',DataItems::adminPassword);
                $this->utils->findElement('xpath','//*[@id="login-form"]/fieldset/div[3]/div[1]/button')->click();
//                //for tha pop-up
//                sleep(3);
//                $this->utils->findElement("xpath","//*[@id=\"html-body\"]/div[4]/aside[1]/div[2]/header/button")->click();
//                sleep(2);
                break;
            case "sellerINadmin":
                echo "Logging in as ".$userType;
                $this->utils->waitUntilElementPresent(DataItems::waitTime,'xpath',"//*[@id='username']")->setValue(DataItems::sellerMail);
                $this->getSession()->getPage()->fillField('login',DataItems::sellerPassword);
                $this->utils->findElement('xpath','//*[@id="login-form"]/fieldset/div[3]/div[1]/button')->click();
                break;
            case "seller":
                echo "Logging in as ".$userType;
                $this->visitPath("udropship/vendor/");
                $this->getSession()->maximizeWindow();
                $this->utils->waitUntilElementPresentAndVisible(DataItems::waitTime,'xpath',"//*[@id='email']")->setValue(DataItems::sellerMail);
                $this->getSession()->getPage()->fillField('pass',DataItems::sellerPassword);
                $this->utils->findElement('xpath','//*[@id="login-form"]/div/div[3]/button')->click();
                break;
            case "buyer":
                echo "Logging in as ".$userType;
                $this->visitPath("/");
                $this->homePage->getCookieOk()->click();
                $this->utils->waitUntilElementPresent(DataItems::waitTime,'xpath',"//*[@class='header links']/li/a[contains(text(),'My Account')]")->click();
                $this->getSession()->maximizeWindow();
                $this->utils->waitUntilElementPresent(DataItems::waitTime,'xpath',"//*[@id='email']")->setValue(DataItems::buyerMail);
                $this->getSession()->getPage()->fillField('pass',DataItems::buyerPassword);
                $this->utils->findElement("xpath","//*[@id='send2']")->click();
                $title = $this->myAccountPage->getTitle()->getText();
                expect($title)->shouldBe("My Dashboard");
                break;
        }
    }

    /**
     * @Given /^I am a logged in "([^"]*)"$/
     */
    public function iAmALoggedIn($userType)
    {
        switch($userType){
            case "admin":
                $this->visitPath("admin45458/");
                break;
            case "seller":
                $this->visitPath("udropship/vendor/");
                break;
            case "buyer":
                $this->visitPath("/customer/account/login/");
                break;
        }
    }

    /**
     * @Then /^I switch to pop up tab$/
     */
    public function iSwitchToPopUpTab()
    {
        $windowNames = $this->getSession()->getWindowNames();
        if(count($windowNames)>1){
            $this->getSession()->switchToWindow($windowNames[1]);
        }
    }

}
