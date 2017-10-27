<?php

namespace BuyerTests;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use BuyerPages\HomePage;
use BuyerPages\LoginPage;
use BuyerPages\MyAccountPage;
use BuyerPages\RecoverPasswordPage;
use UtilsPage\DataItems;
use UtilsPage\Utils;

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
    private $homePage;
    private $myAccountPage;
    private $utils;
    private $loginPage;
    private $recoverPasswordPage;

    public function __construct(RecoverPasswordPage $recoverPasswordPage,LoginPage $loginPage,HomePage $homePage,MyAccountPage $myAccountPage,Utils $utils)
    {
        $this->utils = $utils;
        $this->homePage = $homePage;
        $this->myAccountPage = $myAccountPage;
        $this->loginPage = $loginPage;
        $this->recoverPasswordPage = $recoverPasswordPage;
    }

    /**
     * @Given /^I am a buyer and I write in my username "([^"]*)" and password "([^"]*)"$/
     */
    public function iAmABuyerAndIWriteInMyUsernameAndPassword($username, $password)
    {
        $this->visitPath('/');
        $this->getSession()->maximizeWindow();
        $this->homePage->getMyAccountButton()->click();
        $this->loginPage->getEmailField()->setValue($username);
        $this->loginPage->getPasswordField()->setValue($password);
    }

    /**
     * @When /^I click sign in button$/
     */
    public function iClickSignInButton()
    {
        $this->loginPage->getSignInButton()->click();
    }

    /**
     * @Then /^I will be logged in and see "([^"]*)"$/
     */
    public function iWillBeLoggedInAndSee($arg1)
    {
        $title = $this->myAccountPage->getTitle()->getText();
        expect($title)->shouldBe($arg1);
    }

    /**
     * @Given /^I am an anonymous user$/
     */
    public function iAmAnAnonymousUser()
    {
        echo "Browsing anonymous\r\n";
        $this->visitPath("/");
        $this->getSession()->maximizeWindow();
        $this->homePage->getCookieOk()->click();
    }

    /**
     * @Then /^I am notified that username or password is invalid$/
     */
    public function iAmNotifiedThatUsernameOrPasswordIsInvalid()
    {
        $message = $this->loginPage->getInvalidLoginMsg()->getText();
        expect($message)->shouldBe(DataItems::invalidCredentialsMsg);
    }

    /**
     * @When /^I click on forgot password button$/
     */
    public function iClickOnForgotPasswordButton()
    {
        $this->loginPage->getForgotPasswordButton()->click();
    }

    /**
     * @Then /^I am redirected to password recovery$/
     */
    public function iAmRedirectedToPasswordRecovery()
    {
        $message = $this->recoverPasswordPage->getPageMessage()->getText();
        expect($message)->shouldBe(DataItems::recoverBuyerPasswordMsg);
    }

    /**
     * @Given /^I enter the e\-mail and captcha$/
     */
    public function iEnterTheEMailAndCaptcha()
    {
        $this->recoverPasswordPage->getEmailField()->setValue(DataItems::recoverPassEmailInv);
        $this->recoverPasswordPage->getCaptchaField()->setValue(DataItems::recoverPassCaptchaInv);
    }

    /**
     * @Given /^I click cancel$/
     */
    public function iClickCancel()
    {
        $this->recoverPasswordPage->getCancelButton()->click();
    }

    /**
     * @Then /^E\-mail and captcha fields are emptied$/
     */
    public function eMailAndCaptchaFieldsAreEmptied()
    {
        $email = $this->recoverPasswordPage->getEmailField()->getText();
        $captcha = $this->recoverPasswordPage->getCaptchaField()->getText();
        expect($email)->shouldBe('');
        expect($captcha)->shouldBe('');
    }

    /**
     * @Given /^I am an anonymus user$/
     */
    public function iAmAnAnonymusUser()
    {
        echo "Browsing anonymous\r\n";
        $this->visitPath("/");
        $this->getSession()->maximizeWindow();
    }

    /**
     * @Given /^I am a buyer and I write in my correct username and wrong password$/
     */
    public function iAmABuyerAndIWriteInMyCorrectUsernameAndWrongPassword()
    {
        $this->visitPath('/');
        $this->getSession()->maximizeWindow();
        $this->homePage->getMyAccountButton()->click();
        $this->loginPage->getEmailField()->setValue(DataItems::buyerMail);
        $this->loginPage->getPasswordField()->setValue("wrongpass");
    }

    /**
     * @Then /^I am not logged in and a message is shown regarding invalid credentials$/
     */
    public function iAmNotLoggedInAndAMessageIsShownRegardingInvalidCredentials()
    {


        $message = $this->loginPage->getInvalidLoginMsg()->getText();
        expect($message)->shouldBe(DataItems::invalidCredentialsMsg);
        $dashboard = $this->homePage->getTitle()->getText();
        expect($dashboard)->shouldBe(DataItems::loginPageTitle);
    }

    /**
     * @Given /^I am a buyer and I write in my correct username and password with lowercase$/
     */
    public function iAmABuyerAndIWriteInMyCorrectUsernameAndPasswordWithLowercase()
    {
        $this->visitPath('/');
        $this->getSession()->maximizeWindow();
        $this->homePage->getMyAccountButton()->click();
        $this->loginPage->getEmailField()->setValue(DataItems::buyerMail);
        $this->loginPage->getPasswordField()->setValue(strtolower (DataItems::buyerPassword));
    }

    /**
     * @Given /^I am a buyer and I write in my correct username and password with uppercase$/
     */
    public function iAmABuyerAndIWriteInMyCorrectUsernameAndPasswordWithUppercase()
    {
        $this->visitPath('/');

        $this->homePage->getMyAccountButton()->click();
        $this->getSession()->maximizeWindow();
        $this->loginPage->getEmailField()->setValue(DataItems::buyerMail);
        $this->loginPage->getPasswordField()->setValue(strtoupper(DataItems::buyerPassword));
    }
}
