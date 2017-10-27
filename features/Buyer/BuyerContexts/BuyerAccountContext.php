<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 08-May-17
 * Time: 3:54 PM
 */

namespace BuyerTests;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use SellerPages\RegisterPage;
use UtilsPage\DataItems;
use UtilsPage\Utils;
use BuyerPages\LoginPage;
use BuyerPages\MyAccountPage;
use BuyerPages\HomePage;
use BuyerPages\CreateNewAccPage;

class BuyerAccountContext extends RawMinkContext implements Context
{
    private $homePage;
    private $myAccountPage;
    private $createNewAccPage;
    private $utils;
    private $loginPage;
    private $registerPage;

    public function __construct(LoginPage $loginPage, HomePage $homePage,MyAccountPage $myAccountPage,CreateNewAccPage $createNewAccPage, Utils $utils, RegisterPage $registerPage)
    {
        $this->utils = $utils;
        $this->homePage = $homePage;
        $this->loginPage = $loginPage;
        $this->myAccountPage = $myAccountPage;
        $this->createNewAccPage = $createNewAccPage;
        $this->registerPage = $registerPage;
    }

    /**
     * @When /^I go to to myAccount page$/
     */
    public function iGoToToMyAccountPage()
    {
        $this->visitPath('/');
        $this->homePage->getMyAccountButton()->click();
    }

    /**
     * @Given /^I click on Create an Account$/
     */
    public function iClickOnCreateAnAccount()
    {
        $this->loginPage->getCreateAccButton()->click();
    }

    /**
     * @Then /^I am redirected to account creation page$/
     */
    public function iAmRedirectedToAccountCreationPage()
    {
        $title = $this->createNewAccPage->getTitle()->getText();
        expect($title)->shouldBe(DataItems::createAccTitle);

    }

    /**
     * @Given /^I put in my account information$/
     */
    public function iPutInMyAccountInformation()
    {
        $incremental = $this->utils->incrementContor();
        $this->createNewAccPage->getFirstNameField()->setValue(DataItems::dummyBuyerFirstName.$incremental);
        $this->createNewAccPage->getLastNameField()->setValue(DataItems::dummyBuyerLastName.$incremental);
//        $this->createNewAccPage->getNewsLetterBox()->check();
//        $this->createNewAccPage->getTaxtVatField()->setValue('150');
        $this->createNewAccPage->getEmailField()->setValue($incremental.DataItems::dummyEmail);
        $this->createNewAccPage->getPasswordField()->setValue(DataItems::dummyPassword);
        $this->createNewAccPage->getConfirmPassField()->setValue(DataItems::dummyPassword);
        expect($this->createNewAccPage->getRememberMeBox()->isChecked())->shouldBe(true);

        $this->registerPage->iSwitchToTheFirstIframe();
        $this->registerPage->getReCaptcha()->click();
        $this->registerPage->getCaptchaChecked();
        $this->getSession()->switchToIFrame();

    }

    /**
     * @Given /^I click on create account$/
     */
    public function iClickOnCreateAccount()
    {
        $this->createNewAccPage->getCreateAccButton()->click();
    }

    /**
     * @Then /^I will see confirmation$/
     */
    public function iWillSeeConfirmation1()
    {
        sleep(3);
        $message = $this->myAccountPage->getPageMessage()->getText();
        expect($message)->shouldBe(DataItems::succAccCreateMsg);
    }

    /**
     * @Given /^I will be logged in as my new user$/
     */
    public function iWillBeLoggedInAsMyNewUser()
    {
        $title = $this->myAccountPage->getTitle()->getText();
        expect($title)->shouldBe('My Dashboard');
    }

    /**
     * @Given /^I input my newly created username and password$/
     */
    public function iInputMyNewlyCreatedUsernameAndPassword()
    {
        $contor = $this->utils->getContor();
        $this->getSession()->getPage()->fillField('email',$contor.DataItems::dummyEmail);
        $this->getSession()->getPage()->fillField('pass',DataItems::dummyPassword);
    }


    /**
     * @Given /^I go to "([^"]*)" page$/
     */
    public function iGoToPage($arg1)
    {
        $this->utils->goToMyAccMenu($arg1);
    }


    /**
     * @Then /^I check the change password box$/
     */
    public function iCheckTheChangePasswordBox()
    {
        $this->myAccountPage->getChPassBox()->check();
    }

    /**
     * @Given /^I change my password and save$/
     */
    public function iChangeMyPasswordAndSave()
    {
        $contor = $this->utils->getContor();
        $this->myAccountPage->getCurrentPassField()->setValue(DataItems::dummyPassword);
        echo "contor ".$contor;
        $this->myAccountPage->getNewPassField()->setValue($contor.DataItems::dummyPassword);
        $this->myAccountPage->getConfNewPassField()->setValue($contor.DataItems::dummyPassword);
        $this->myAccountPage->getSaveButton()->click();
    }

    /**
     * @Then /^I logout$/
     */
    public function iLogout()
    {
        $this->utils->goToMyAccMenu("Logout");
    }

    /**
     * @When /^I input my new credentials$/
     */
    public function iInputMyNewCredentials()
    {
        $this->homePage->getMyAccountButton()->click();
        $contor = $this->utils->getContor();
        $this->loginPage->getEmailField()->setValue($contor.DataItems::dummyEmail);
        $this->loginPage->getPasswordField()->setValue($contor.DataItems::dummyPassword);
    }

    /**
     * @When /^I input my new e\-mail and password$/
     */
    public function iInputMyNewEMailAndPassword()
    {
        $this->homePage->getMyAccountButton()->click();
        $contor = $this->utils->getContor();
        $this->loginPage->getEmailField()->setValue(DataItems::editItem.$contor.DataItems::dummyEmail);
        $this->loginPage->getPasswordField()->setValue($contor.DataItems::dummyPassword);
    }

    /**
     * @Given /^I input my newly created username and changed password$/
     */
    public function iInputMyNewlyCreatedUsernameAndChangedPassword()
    {
        $this->homePage->getMyAccountButton()->click();
        $contor = $this->utils->getContor();
        echo "new email".$contor.DataItems::dummyEmail."\r\n";
        echo "new password".$contor.DataItems::dummyPassword;
        $this->loginPage->getEmailField()->setValue($contor.DataItems::dummyEmail);
        $this->loginPage->getPasswordField()->setValue($contor.DataItems::dummyPassword);
    }

    /**
     * @Then /^I will see update confirmation message$/
     */
    public function iWillSeeUpdateConfirmationMessage()
    {
        echo "Check MKTPRD-456 issue! \r\n";
        expect("bug")->shouldBe("fixed");
    }

    /**
     * @Then /^I will see update confirmation message "([^"]*)"$/
     */
    public function iWillSeeUpdateConfirmationMessage1($arg1)
    {
        sleep(3);
        $message = $this->myAccountPage->getPageMessage()->getText();
        expect($message)->shouldBe($arg1);
    }

    /**
     * @Given /^I click on Edit button from My Account information$/
     */
    public function iClickOnEditButtonFromMyAccountInformation()
    {
        $this->myAccountPage->getEditAccInfoButton()->click();
    }

    /**
     * @Then /^I am redirected to "([^"]*)" page$/
     */
    public function iAmRedirectedToPage($arg1)
    {
        $title = $this->myAccountPage->getTitle()->getText();
        expect($title)->shouldBe($arg1);
    }

    /**
     * @Given /^I check the change e\-mail box$/
     */
    public function iCheckTheChangeEMailBox()
    {
        $this->myAccountPage->getChEmailBox()->check();
    }

    /**
     * @Given /^I change my account information$/
     */
    public function iChangeMyAccountInformation()
    {
        $firstName = $this->myAccountPage->getFirstNameField()->getAttribute('value');
        $this->myAccountPage->getFirstNameField()->setValue($firstName.DataItems::editItem);

        $secondName = $this->myAccountPage->getSecondNameField()->getAttribute('value');
        $this->myAccountPage->getSecondNameField()->setValue($secondName.DataItems::editItem);

//        $tax = $this->myAccountPage->getTaxVatField()->getAttribute('value');
//        $this->myAccountPage->getTaxVatField()->setValue($tax.DataItems::editItem);

        $email = $this->myAccountPage->getEmailField()->getAttribute('value');;
        $this->myAccountPage->getEmailField()->setValue(DataItems::editItem.$email);

        $contor = $this->utils->getContor();
        $this->myAccountPage->getCurrentPassField()->setValue($contor.DataItems::dummyPassword);
    }

    /**
     * @Given /^I save the changes$/
     */
    public function iSaveTheChanges()
    {
        $this->myAccountPage->getSaveButton()->click();
    }

    /**
     * @Then /^I will be logged in and see my updated information$/
     */
    public function iWillBeLoggedInAndSeeMyUpdatedInformation()
    {
        $info = $this->myAccountPage->getAccountInfo()->getText();
        $separatedInfo = explode(" ",$info);

        echo $separatedInfo[0]."\r\n";
        echo $separatedInfo[1]."\r\n";
        echo $separatedInfo[2]."\r\n";

    }

    /**
     * @Then /^I will see my updated information$/
     */
    public function iWillSeeMyUpdatedInformation()
    {
        $contor = $this->utils->getContor();

        $firstName = $this->myAccountPage->getFirstNameField()->getAttribute('value'); //issue MKTPRD-447
        expect($firstName)->shouldBe(DataItems::dummyBuyerFirstName.$contor.DataItems::editItem);

        $secondName = $this->myAccountPage->getSecondNameField()->getAttribute('value');
        expect($secondName)->shouldBe(DataItems::dummyBuyerLastName.$contor.DataItems::editItem);

//        $tax = $this->myAccountPage->getTaxVatField()->getAttribute('value');
//        expect($tax)->shouldBe($tax.DataItems::editItem);

        $email = $this->myAccountPage->getEmailField()->getAttribute('value');;
        expect($email)->shouldBe(DataItems::editItem.$contor.DataItems::dummyEmail);
    }

    /**
     * @Given /^I input my old password$/
     */
    public function iInputMyOldPassword()
    {
        $contor = $this->utils->getContor();
        $this->getSession()->getPage()->fillField('email',$contor.DataItems::dummyEmail);
        $this->getSession()->getPage()->fillField('pass',DataItems::dummyPassword);
    }

    /**
     * @Given /^I click on first View Invoice$/
     */
    public function iClickOnFirstViewInvoice()
    {
       $this->myAccountPage->getFirstViewInvoice()->click();
    }

    /**
     * @Then /^The invoice is opened$/
     */
    public function theInvoiceIsOpened()
    {
        $windowNames = $this->getSession()->getWindowNames();
        if(count($windowNames)>1){
            $this->getSession()->switchToWindow($windowNames[1]);
        }

        $invoiceURL = $this->getSession()->getCurrentUrl();
        expect($invoiceURL) -> shouldBe("https://market.preprod.thingpark.com/pub/media/invoices/0/0/000000292.pdf");
    }


}