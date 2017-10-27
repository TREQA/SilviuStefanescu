<?php

namespace SellerTests;

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use SellerPages\SellerValues;
use UtilsPage\Utils;
use UtilsPage\DataItems;
use SellerPages\LoginPage;
use SellerPages\RegisterPage;
use SellerPages\HomePage;

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
    private $loginPage;
    private $registerPage;
    private $homepage;

    public function __construct(HomePage $homepage , RegisterPage $registerPage, LoginPage $loginPage,Utils $utils)
    {
        $this->utils = $utils;
        $this->loginPage = $loginPage;
        $this->registerPage = $registerPage;
        $this->homepage = $homepage;
    }

    /**
     * @Given /^I am a seller and I write in my username "([^"]*)" and password "([^"]*)"$/
     */
    public function iAmASellerAndIWriteInMyUsernameAndPassword($username, $password)
    {
        $this->visitPath(DataItems::sellerPath);
        $this->getSession()->getPage()->fillField('email',$username);
        $this->getSession()->getPage()->fillField('pass',$password);
    }

    /**
     * @When /^I click seller sign in button$/
     */
    public function iClickSellerSignInButton()
    {
        $this->getSession()->getPage()->find('xpath','//*[@id="login-form"]/div/div[3]/button')->click();
    }

    /**
     * @Then /^I will be logged in and see the "([^"]*)"$/
     */
    public function iWillBeLoggedInAndSeeThe($arg1)
    {
        $orders = $this->getSession()->getPage()->find('xpath','//*[@class="page-title"]/h1');
        expect($orders->getText())->toBe($arg1);
    }

    /**
     * @Then /^I will be redirected to seller login page$/
     */
    public function iWillBeRedirectedToSellerLoginPage()
    {
        $url = $this->getSession()->getCurrentUrl();
        expect($url)->shouldBe(DataItems::sellerLoginPath);
        $title = $this->loginPage->getPageTitle()->getText();
        expect($title)->shouldBe(DataItems::sellerLoginPageTitle);
        $this->loginPage->getEmailField();
        $this->loginPage->getPasswordField();
        $login = $this->loginPage->getLoginButton()->getText();
        $register = $this->loginPage->getRegisterNewButton()->getText();
        expect($login)->shouldBe('Login');
        expect($register)->shouldBe('Register New Account');
    }

    /**
     * @Given /^I am an anonymous seller user$/
     */
    public function iAmAnAnonymousSellerUser()
    {
        $this->visitPath(DataItems::sellerPath);
    }

    /**
     * @Given /^I am a seller and I write in my valid username and invalid password$/
     */
    public function iAmASellerAndIWriteInMyValidUsernameAndInvalidPassword()
    {
        $this->visitPath(DataItems::sellerPath);
        $this->loginPage->getEmailField()->setValue(DataItems::sellerMail);
        $this->loginPage->getPasswordField()->setValue("wrongpass");
    }

    /**
     * @Then /^I will be on login page and a message regarding invalid credentials is shown$/
     */
    public function iWillBeOnLoginPageAndAMessageRegardingInvalidCredentialsIsShown()
    {
        $message = $this->loginPage->getInvalidCredMsg()->getText();
        expect($message)->shouldBe(DataItems::sellerInvalidCredMsg);
        $title = $this->loginPage->getPageTitle()->getText();
        expect($title)->shouldBe(DataItems::sellerLoginPageTitle);
    }

    /**
     * @Given /^I am a seller and I write in my valid username and valid password with lowercase$/
     */
    public function iAmASellerAndIWriteInMyValidUsernameAndValidPasswordWithLowercase()
    {
        $this->visitPath(DataItems::sellerPath);
        $this->loginPage->getEmailField()->setValue(DataItems::sellerMail);
        $this->loginPage->getPasswordField()->setValue(strtolower(DataItems::sellerPassword));
    }

    /**
     * @Given /^I am a seller and I write in my valid username and valid password with uppercase$/
     */
    public function iAmASellerAndIWriteInMyValidUsernameAndValidPasswordWithUppercase()
    {
        $this->visitPath(DataItems::sellerPath);
        $this->loginPage->getEmailField()->setValue(DataItems::sellerMail);
        $this->loginPage->getPasswordField()->setValue(strtoupper(DataItems::sellerPassword));
    }

    /**
     * @Given /^I click on Register New Account$/
     */
    public function iClickOnRegisterNewAccount()
    {
        $this->loginPage->getRegisterNewButton()->click();
    }

    /**
     * @Then /^I am redirected to register page and all necessary fields are present$/
     */
    public function iAmRedirectedToRegisterPageAndAllNecessaryFieldsArePresent()
    {
        $url = $this->getSession()->getCurrentUrl();
        expect($url)->shouldBe(DataItems::path.DataItems::sellerRegisterPath);

        $foundTitle = $this->registerPage->getPageTitle()->getText();
        $foundMandatoryLabel = $this->registerPage->getMandatoryFieldLabel()->getText();

        $foundContactInfLabel = $this->registerPage->getContactInfLabel()->getText();
        $foundFirstNameLabel = $this->registerPage->getFirstNameLabel()->getText();
        $foundLastNameLabel = $this->registerPage->getLastNameLabel()->getText();
        $foundEmailLabel = $this->registerPage->getEmailAddressLabel()->getText();
        $foundPhoneLabel = $this->registerPage->getPhoneLabel()->getText();

        $foundCompanyInfLabel = $this->registerPage->getCompanyInfLabel()->getText();
        $foundCompanyNameLabel = $this->registerPage->getCompanyNameLabel()->getText();
        $foundCountryLabel = $this->registerPage->getCountryLabel()->getText();
        $foundCityLabel = $this->registerPage->getCityLabel()->getText();
        $foundAddressLabel = $this->registerPage->getAddressLabel()->getText();
        $foundZipCodeLabel = $this->registerPage->getZipCodeLabel()->getText();

        $fountTcLink = $this->registerPage->getTcLink()->getText();

        $foundCommentLabel = $this->registerPage->getCommentLabel()->getText();

        $foundRegisterBtnLabel = $this->registerPage->getRegisterBtn()->getText();
        $foundBackToLoginBtnLabel = $this->registerPage->getBackToLoginBtn()->getText();;


        expect($foundTitle)->shouldBe("Become a Seller");
        expect($foundMandatoryLabel)->shouldBe("* Indicated Required Fields");

        expect($foundContactInfLabel)->shouldBe("Contact information");
        expect($foundFirstNameLabel)->shouldBe("First Name*");
        expect($foundLastNameLabel)->shouldBe("Last Name*");
        expect($foundEmailLabel)->shouldBe("Email Address*");
        expect($foundPhoneLabel)->shouldBe("Phone number*");

        expect($foundCompanyInfLabel)->shouldBe("Company information");
        expect($foundCompanyNameLabel)->shouldBe("Company name*");
        expect($foundCountryLabel)->shouldBe("Country*");
        expect($foundZipCodeLabel)->shouldBe("Zip code*");
        expect($foundCityLabel)->shouldBe("City*");
        expect($foundAddressLabel)->shouldBe("Address*");

        expect($foundCommentLabel)->shouldBe("Comments");
        expect($foundRegisterBtnLabel)->shouldBe("Register");
        expect($foundBackToLoginBtnLabel)->shouldBe("Return to log in");

        expect($fountTcLink)->shouldBe("I have read and understand and agree to abide by its terms. *");
    }

    /**
     * @Given /^I complete all the mandatory fields for seller registration$/
     */
    public function iCompleteAllTheMandatoryFieldsForSellerRegistration()
    {
        DataItems::$randomInt = $this->utils->randomInt();
        SellerValues::$randSellerEmail = DataItems::$randomInt.SellerValues::dummySellerEmail;
        SellerValues::$randDummyCompanyName = DataItems::$randomInt.SellerValues::dummyCompanyName;

        $this->registerPage->getFirstNameField()->setValue(SellerValues::dummySellerFirstName);
        $this->registerPage->getLastNameField()->setValue(SellerValues::dummySellerLastName);
        $this->registerPage->getEmailField()->setValue(SellerValues::$randSellerEmail);
        $this->registerPage->getPhoneField()->setValue(SellerValues::dummyPhone);
        $this->registerPage->getCompanyNameField()->setValue(SellerValues::$randDummyCompanyName);
        $this->registerPage->getCountryDropdown()->selectOption(SellerValues::dummyCountry);
        $this->registerPage->getCityField()->setValue(SellerValues::dummyCity);
        $this->registerPage->getAddressField()->setValue(SellerValues::dummyAddress);
        $this->registerPage->getZipCodeField()->setValue(SellerValues::dummyZipCode);
        $this->registerPage->getAgreeTcCheckbox(true);

        $this->registerPage->iSwitchToTheFirstIframe();
        $this->registerPage->getReCaptcha()->click();
        $this->registerPage->getCaptchaChecked();
        $this->getSession()->switchToIFrame();


    }

    /**
     * @Then /^I click on Register$/
     */
    public function iClickOnRegister()
    {
        $this->registerPage->getRegisterBtn()->click();
    }

    /**
     * @Then /^a message regarding seller registration is displayed$/
     */
    public function aMessageRegardingSellerRegistrationIsDisplayed()
    {
        $msg = $this->loginPage->getSuccessMsg()->getText();
        expect($msg)->shouldBe(SellerValues::sellerRegistrationMsg);
    }

    /**
     * @Then /^I login with the newly created vendor$/
     */
    public function iLoginWithTheNewlyCreatedVendor()
    {
        $this->visitPath(DataItems::sellerPath);
        $this->loginPage->getEmailField()->setValue(SellerValues::$randSellerEmail);
        $this->loginPage->getPasswordField()->setValue(SellerValues::dummyPassword);
        $this->loginPage->getLoginButton()->click();
    }

    /**
     * @Then /^All mandatory fields will be highlighted properly$/
     */
    public function allMandatoryFieldsWillBeHighlightedProperly()
    {
        echo "nu merge";
    }

    /**
     * @Then /^Rejection message is displayed$/
     */
    public function rejectionMessageIsDisplayed()
    {
        $msg = $this->loginPage->getRejectMsg()->getText();
        expect ($msg) -> shouldBe(SellerValues::sellerRejectionMsg);
    }


}
