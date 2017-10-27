<?php

namespace AdminTests;

use AdminPages\EditOrderPage;
use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use UtilsPage\DataItems;
use UtilsPage\Utils;
use Webmozart\Assert\Assert;

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
    private $utils;
    private $editOrderPage;

    public function __construct(EditOrderPage $editOrderPage, Utils $utils)
    {
        $this->utils = $utils;
        $this->editOrderPage = $editOrderPage;
    }

    /**
     * @Given /^I am an admin and I write in my username "([^"]*)" and password "([^"]*)"$/
     */
    public function iAmAnAdminAndIWriteInMyUsernameAndPassword($username, $password)
    {
        $this->visitPath("admin45458/");
        $this->getSession()->getPage()->fillField('username',$username);
        $this->getSession()->getPage()->fillField('login',$password);
    }

    /**
     * @When /^I click admin sign in button$/
     */
    public function iClickAdminSignInButton()
    {
        $this->getSession()->getPage()->find('xpath','//*[@class="action-login action-primary"]')->click();
    }
    /**
     * @Then /^I will be logged in and see my "([^"]*)"$/
     */
    public function iWillBeLoggedInAndSeeMy($arg1)
    {
        $dashboard = $this->getSession()->getPage()->find('xpath','//*[@id="content"]/h2');
        expect($dashboard->getText())->shouldBe($arg1);
    }


//    /**
//     * @Given /^I am a buyer and I write in my correct username and password with lowercase$/
//     */
//    public function iAmABuyerAndIWriteInMyCorrectUsernameAndPasswordWithLowercase()
//    {
//        $this->visitPath('/');
//        $this->getSession()->maximizeWindow();
//        $this->homePage->getMyAccountButton()->click();
//        $this->loginPage->getEmailField()->setValue(DataItems::buyerMail);
//        $this->loginPage->getPasswordField()->setValue(strtolower (DataItems::buyerPassword));
//    }
//
//    /**
//     * @Given /^I am a "([^"]*)" and I write in my correct username and password with lowercase$/
//     */
//    public function iAmAAndIWriteInMyCorrectUsernameAndPasswordWithLowercase($userType){
//
//        switch($userType){
//            case "admin":
//                echo "Logging in as ".$userType;
//                $this->visitPath("admin45458/");
//                $this->getSession()->maximizeWindow();
//                $this->utils->waitUntilElementPresent(DataItems::waitTime,'xpath',"//*[@id='username']")->setValue(DataItems::adminMail);
//                $this->getSession()->getPage()->fillField('login',"Password@123");
//                $this->utils->findElement('xpath','//*[@id="login-form"]/fieldset/div[3]/div[1]/button')->click();
//
//                break;
//            case "sellerINadmin":
//                echo "Logging in as ".$userType;
//                $this->utils->waitUntilElementPresent(DataItems::waitTime,'xpath',"//*[@id='username']")->setValue(DataItems::sellerMail);
//                $this->getSession()->getPage()->fillField('login',DataItems::sellerPassword);
//                $this->utils->findElement('xpath','//*[@id="login-form"]/fieldset/div[3]/div[1]/button')->click();
//                break;
//            case "seller":
//                echo "Logging in as ".$userType;
//                $this->visitPath("udropship/vendor/");
//                $this->getSession()->maximizeWindow();
//                $this->utils->waitUntilElementPresentAndVisible(DataItems::waitTime,'xpath',"//*[@id='email']")->setValue(DataItems::sellerMail);
//                $this->getSession()->getPage()->fillField('pass',DataItems::sellerPassword);
//                $this->utils->findElement('xpath','//*[@id="login-form"]/div/div[3]/button')->click();
//                break;
//            case "buyer":
//                echo "Logging in as ".$userType;
//                $this->visitPath("/");
//                $this->homePage->getCookieOk()->click();
//                $this->utils->waitUntilElementPresent(DataItems::waitTime,'xpath',"//*[@class='header links']/li/a[contains(text(),'My Account')]")->click();
//                $this->getSession()->maximizeWindow();
//                $this->utils->waitUntilElementPresent(DataItems::waitTime,'xpath',"//*[@id='email']")->setValue(DataItems::buyerMail);
//                $this->getSession()->getPage()->fillField('pass',DataItems::buyerPassword);
//                $this->utils->findElement("xpath","//*[@id='send2']")->click();
//                $title = $this->myAccountPage->getTitle()->getText();
//                expect($title)->shouldBe("My Dashboard");
//                break;
//        }
//
//    }
//
//    /**
//     * @Then /^I am not logged in as an admin and a message is shown regarding invalid credentials$/
//     */
//    public function iAmNotLoggedInAsAnAdminAndAMessageIsShownRegardingInvalidCredentials()
//    {
//        $errorMsg = $this->editOrderPage->getLoginError()->getText();
//        expect($errorMsg)->shouldBe(DataItems::$noPriceProdRand);
//    }
}
 ?>

