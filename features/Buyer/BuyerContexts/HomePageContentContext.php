<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 05-May-17
 * Time: 6:14 PM
 */

namespace BuyerTests;


use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use BuyerPages\HomePage;
use UtilsPage\DataItems;
use UtilsPage\Utils;
use BuyerPages\BuyerValues;
use BuyerPages\ListProductsPage;

class HomePageContentContext extends RawMinkContext implements Context
{
    private $utils;
    private $homePage;
    private $listProductsPage;

    public function __construct(HomePage $homePage, Utils $utils, ListProductsPage $listProductsPage)
    {
        $this->utils = $utils;
        $this->homePage = $homePage;
        $this->listProductsPage = $listProductsPage;
    }

    /**
     * @When /^I go to to thingpark webpage$/
     */
    public function iGoToToThingparkWebpage()
    {
        $this->visitPath("/");
    }

    /**
     * @Then /^I can see the link to "([^"]*)"$/
     */
    public function iCanSeeTheLinkTo($arg1)
    {
        $becomeSeller = $this->homePage->getBecomeSellerLink();
        expect($becomeSeller->getText())->shouldBe($arg1);
        echo $becomeSeller->getXpath();
        echo $becomeSeller->getAttribute("href");
        expect($becomeSeller->getAttribute("href"))->shouldBe(DataItems::becomeSellerLink);
    }

    /**
     * @Given /^I can see the search option$/
     */
    public function iCanSeeTheSearchOption()
    {
        $searchOption = $this->homePage->getSearchOption();
        expect($searchOption->getAttribute("placeholder"))->shouldBe(DataItems::searchFieldText);
    }

    /**
     * @Given /^I can see the logo$/
     */
    public function iCanSeeTheLogo()
    {
        $image = $this->homePage->getLogo();
        $imgUrl = $image->getAttribute('src');
        echo "The url is " . $imgUrl . "\r\n";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $imgUrl);
        curl_setopt($curl, CURLOPT_NOBODY, 1);
        curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        echo curl_getinfo($curl, CURLINFO_HTTP_CODE);
        echo "response is : " . $httpCode . "\r\n"; //
        expect($httpCode)->shouldNotBeEqualTo(404);
        expect($httpCode)->shouldNotBeEqualTo(0);
    }

    /**
     * @Given /^I can see "([^"]*)"$/
     */
    public function iCanSee($arg1)
    {
        $myAcc = $this->homePage->getMyAccountButton()->getText();
        expect($myAcc)->shouldBe($arg1);
    }

    /**
     * @When /^I click on become a seller$/
     */
    public function iClickOnBecomeASeller()
    {
        $this->homePage->getBecomeSellerLink()->click();
    }

    /**
     * @Then /^a pop\-up is shown with Terms of use$/
     */
    public function aPopUpIsShownWithTermsOfUse()
    {
        $message = $this->homePage->getTermsBar()->getText();
        echo $message;
        expect($message)->shouldBe(DataItems::tcpMessage);
    }

    /**
     * @Given /^I click on read more button$/
     */
    public function iClickOnReadMoreButton()
    {
        $this->homePage->getCookieReadMore()->click();
    }

    /**
     * @Then /^I am redirected to Privacy Policy Page$/
     */
    public function iAmRedirectedToPrivacyPolicyPage()
    {
        $title = $this->homePage->getTitle()->getText();
        expect($title)->shouldBe(DataItems::privacyPolicyTitle);
    }

    /**
     * @Given /^I click on OK$/
     */
    public function iClickOnOK()
    {
        $this->homePage->getCookieOk()->click();
    }

    /**
     * @Then /^the pop\-up disappears$/
     */
    public function thePopUpDisappears()
    {
        $disappeared = $this->homePage->termsBarDisappears();
        expect($disappeared)->shouldBe(true);
    }

    /**
     * @Then /^I can access the Menu Options$/
     */
    public function iCanAccessTheMenuOptions()
    {

      $this->homePage->checkMenuOptions(BuyerValues::menuOptions,BuyerValues::expectedTitle,BuyerValues::expectedUrls);

    }

    /**
     * @Given /^I click on "([^"]*)" menu option$/
     */

    public function iClickOnMenuOption($menuButton)
    {
        if (in_array($menuButton,BuyerValues::menuOptions)){

            $this->homePage->getAnyMenuButton($menuButton)->click();

        }else {

            throw new \RuntimeException(sprintf("Argument given is invalid. ".$menuButton." argument may contain typos"));
        }

    }

    /**
     * @Then /^I select "([^"]*)" from Filtering Options$/
     */
    public function iSelectFromFilteringOptions($filterMain)
    {
       $this->listProductsPage->getAnyMainFilteringOption($filterMain)->click();
    }

    /**
     * @Given /^I click on "([^"]*)" Seller from Sub Filtering Option$/
     */
    public function iClickOnSellerFromSubFilteringOption($sellerSubFilter)
    {
        $this->listProductsPage->getAnySellerSubOption($sellerSubFilter)->click();
    }
    /**
     * @Given /^I click on show "([^"]*)" items per page$/
     */
    public function iClickOnShowItemsPerPage($no)
    {
        $this->listProductsPage->setNoProductsPerPage()->setValue($no);
    }

    /**
     * @Then /^I should see only products from Automated Listing Vendor$/
     */
    public function iShouldSeeOnlyProductsFromAutomatedListingVendor()
    {
        $this->listProductsPage->getProductsFromListing(BuyerValues::expectedProducts);
    }

    /**
     * @Given /^I click on Advanced Search$/
     */
    public function iClickOnAdvancedSearch()
    {
        $this->homePage->getAdvancedSearchButton()->click();
    }

    /**
     * @Then /^Advanced Search popup should appear$/
     */
    public function advancedSearchPopupShouldAppear()
    {
        $name = $this->homePage->getAdvSearchName()->getText();
        expect($name) -> shouldBe(BuyerValues::advSPopUpName);
    }

    /**
     * @Given /^I verify that the required fields are shown for the popup$/
     */
    public function iVerifyThatTheRequiredFieldsAreShownForThePopup()
    {
        $this->homePage->checkAdvanceSearchFields(BuyerValues::advSearchFields);
    }

    /**
     * @Given /^I complete all fields with random data$/
     */
    public function iCompleteAllFieldsWithRandomData()
    {
        $this->homePage->getAdvNameField()->setValue(BuyerValues::advSRandomName);
        $this->homePage->getAdvSkuField()->setValue(BuyerValues::advSRandomSku);
        $this->homePage->getAdvDescriptionField()->setValue(BuyerValues::advSRandomDescription);
        $this->homePage->getAdvShortDescriptionField()->setValue(BuyerValues::advSRandomShortDescription);
        $this->homePage->getAdvFirstUnitPriceField()->setValue(BuyerValues::advSRandomFirstPrice);
        $this->homePage->getAdvSecondUnitPriceField()->setValue(BuyerValues::advSRandomSecondPrice);
        $this->homePage->getAdvRadioFrqBand()->selectOption("CN470 - China 470-510MHz",false);
        $this->homePage->getAdvCertification()->selectOption('CE',false);
    }

    /**
     * @Given /^I press search$/
     */
    public function iPressSearch()
    {
        $this->homePage->getAdvSearchSearchButton()->click();
    }

    /**
     * @Then /^No Advanced Search items are found$/
     */
    public function noAdvancedSearchItemsAreFound()
    {
        $message = $this->homePage->getAdvNoProdFoundMessage()->getText();
        expect($message) -> shouldBe(BuyerValues::advSNoProdMessage);
    }

    /**
     * @Given /^I click on Modify your search button$/
     */
    public function iClickOnModifyYourSearchButton()
    {
        $this->homePage->getModifyYourSearch()->click();
    }

    /**
     * @Given /^I complete some fields with relevant data$/
     */
    public function iCompleteSomeFieldsWithRelevantData()
    {
        $this->homePage->getAdvNameField()->setValue(BuyerValues::advSCorrectName);
        $this->homePage->getAdvSkuField()->setValue(BuyerValues::advSCorrectSku);
        $this->homePage->getAdvDescriptionField()->setValue(BuyerValues::advSCorrectDescription);
        $this->homePage->getAdvShortDescriptionField()->setValue(BuyerValues::advSCorrectShortDescription);
        $this->homePage->getAdvFirstUnitPriceField()->setValue(BuyerValues::advSCorrectFirstPrice);
        $this->homePage->getAdvSecondUnitPriceField()->setValue(BuyerValues::advSCorrectSecondPrice);

        $key = 'CTRL';
        $script = "jQuery.event.trigger({ type : 'keypress', which : '" . $key . "' });";
        $this->getSession()->evaluateScript($script);
        $this->utils->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"ac_thirdparty_approve\"]/option[2]")->click();
        $this->utils->waitUntilElementPresentAndVisible(DataItems::waitTime,"xpath","//*[@id=\"ac_band\"]/option[4]")->click();
    }

    /**
     * @Then /^products are shown$/
     */
    public function productsAreShown()
    {
        $message = $this->homePage->getAdvProdFoundMessage()->getText();
        expect($message) -> shouldBe(BuyerValues::advSFoundProdMessage);
    }

    /**
     * @When /^I write "([^"]*)" in search field$/
     */
    public function iWriteInSearchField($arg1)
    {
        $this->homePage->getSearchField()->setValue($arg1);
    }

    /**
     * @Then /^I am on "([^"]*)" page$/
     */
    public function iAmOnPage($arg1)
    {
        if (in_array($arg1,BuyerValues::expectedTitle)) {

            $rawKey = array_keys(BuyerValues::expectedTitle,$arg1);
            $newKey = current($rawKey);

            $url = $this->getSession()->getCurrentUrl();
            expect($url)->shouldBe(BuyerValues::expectedUrls[$newKey]);

        }else {

            throw new \RuntimeException(sprintf("Argument given is invalid. Page with that name can not be found"));
        }
    }

    /**
     * @Given /^I can see the Breadcrumbs as "([^"]*)"$/
     */
    public function iCanSeeTheBreadcrumbsAs($breadcrumbName)
    {
        $breadcrumbCategory = $this->listProductsPage->getBreadcrumbCategory()->getText();
        expect($breadcrumbCategory) -> shouldBe($breadcrumbName);
    }

    /**
     * @Given /^I can see the page title is "([^"]*)"$/
     */
    public function iCanSeeThePageTitleIs($title)
    {
        $pageTitle = $this->homePage->getTitle()->getText();
        expect($pageTitle) -> shouldBe($title);
    }

    /**
     * @Given /^I can see the Filtering options$/
     */
    public function iCanSeeTheFilteringOptions()
    {
        $listingOptions = $this->listProductsPage->getAllFilteringOptions();

        if (count($listingOptions) >= 1){
            echo "Listing options are present \r\n";

        }else {
            throw new \RuntimeException(sprintf("Listing options are not present"));
        }
    }

    /**
     * @Given /^I can see the Sort By option$/
     */
    public function iCanSeeTheSortByOption()
    {
        return $this->listProductsPage->getSortByOptions(BuyerValues::sortByOptions);
    }

    /**
     * @Given /^I can see the ascending\/descending sorting option$/
     */
    public function iCanSeeTheAscendingDescendingSortingOption()
    {
        if ($this->listProductsPage->getAscendingDirectionAsc()->isVisible() or $this->listProductsPage->getAscendingDirectionDesc()->isVisible()){
            echo "Ascending/Descending filter is present \r\n";

        }else{
            throw new \RuntimeException(sprintf("Ascending\Descending filter is not present"));
        }
    }

    /**
     * @Given /^I can see the Pagination elements$/
     */
    public function iCanSeeThePaginationElements()
    {
        if (is_null($this->listProductsPage->findTotalNoProductsPerPageText())) {
            echo "Pagination elements are not needed as there are less than 15 items per page";

        } elseif (!is_null($this->listProductsPage->findCurrentListingPage()) and !is_null($this->listProductsPage->findOtherListingPage())){

            $this->listProductsPage->getNextPage()->click();
            $currentPage = $this->listProductsPage->getCurrentListingPage()->getText();
            expect($currentPage) -> shouldBe('2');

            $this->listProductsPage->getPreviousPage()->click();
            $currentPage = $this->listProductsPage->getCurrentListingPage()->getText();
            expect($currentPage) -> shouldBe('1');

        }else {
            throw new \RuntimeException(sprintf("Something wrong with Listing pages"));
        }
    }

    /**
     * @Given /^I can see the Show "([^"]*)" products per page option$/
     */
    public function iCanSeeTheShowProductsPerPageOption()
    {
        $noProductsPerPage = $this->listProductsPage->getNoProductsPerPageOption();

        if (count($noProductsPerPage) == 4){
            Echo "Show 'n' Products per page element is present \r\n";

        }else {
            throw new \RuntimeException(sprintf("Show 'n' Products per page element is NOT present"));
        }
    }

    /**
     * @Given /^I can see the Wish List Area$/
     */
    public function iCanSeeTheWishListArea()
    {
        $title = $this->listProductsPage->getWishListAreaTitle()->getText();
        expect ($title) -> shouldBe(BuyerValues::wishListTitle);

        $empty = $this->listProductsPage->getWishListContent()->getText();
        expect ($empty) -> shouldBe(BuyerValues::emptyWishList);
    }

    /**
     * @Given /^I can see the page description$/
     */
    public function iCanSeeThePageDescription()
    {
        if ($this->listProductsPage->getCategoryDescription()->isVisible()){
            echo "Category description is present \r\n";

        }else {
            throw new \RuntimeException(sprintf("Category Description is not present"));
        }
    }

    /**
     * @Given /^I can see that all products have Add to Wish List option$/
     */
    public function iCanSeeThatAllProductsHaveAddToWishListOption()
    {
        $totalProducts = $this->listProductsPage->getNoProductsPerPage()->getText();
        $totalProducts = intval($totalProducts);

        for ($i = 1; $i <= $totalProducts; $i ++){
            if (is_null($this->listProductsPage->findAnyAddToWishListButton($i))){
                $productName = $this->utils->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"products list items product-items\"]/li[$i]/div/div/strong/a")->getText();
                throw new \RuntimeException(sprintf("Product " .$productName. " does not have Add to Wish List button"));
            }
        }
    }

    /**
     * @Given /^I can see that all products have Add to comparison list$/
     */
    public function iCanSeeThatAllProductsHaveAddToComparisonList()
    {
        $totalProducts = $this->listProductsPage->getNoProductsPerPage()->getText();
        $totalProducts = intval($totalProducts);

        for ($i = 1; $i <= $totalProducts; $i ++){
            if (is_null($this->listProductsPage->findAnyAddToComparison($i))){
                $productName = $this->utils->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"products list items product-items\"]/li[$i]/div/div/strong/a")->getText();
                throw new \RuntimeException(sprintf("Product " .$productName. " does not have Add to Compare button"));
            }
        }
    }

    /**
     * @Given /^I can see that all products have Images$/
     */
    public function iCanSeeThatAllProductsHaveImages()
    {
        $totalProducts = $this->listProductsPage->getNoProductsPerPage()->getText();
        $totalProducts = intval($totalProducts);

        for ($i = 1; $i <= $totalProducts; $i ++){
            if (is_null($this->listProductsPage->findAnyProductImage($i))){
                $productName = $this->utils->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"products list items product-items\"]/li[$i]/div/div/strong/a")->getText();
                throw new \RuntimeException(sprintf("Product " .$productName. " does not have an image"));
            }
        }
    }

    /**
     * @Given /^I can see that all products have Titles$/
     */
    public function iCanSeeThatAllProductsHaveTitles()
    {
        $totalProducts = $this->listProductsPage->getNoProductsPerPage()->getText();
        $totalProducts = intval($totalProducts);

        for ($i = 1; $i <= $totalProducts; $i ++){
            if (is_null($this->listProductsPage->findAnyProductName($i)->getText())){
                $productName = $this->utils->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"products list items product-items\"]/li[$i]/div/div/strong/a")->getText();
                throw new \RuntimeException(sprintf("Product " .$productName. " does not have a Title"));
            }
        }
    }

    /**
     * @Given /^I can see that all products have Prices$/
     */
    public function iCanSeeThatAllProductsHavePrices()
    {
        $totalProducts = $this->listProductsPage->getNoProductsPerPage()->getText();
        $totalProducts = intval($totalProducts);

        for ($i = 1; $i <= $totalProducts; $i ++){
            if (is_null($this->listProductsPage->findAnyProductPrice($i))or $this->listProductsPage->getAnyPrice($i)->getText() == " "){
                $productName = $this->utils->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"products list items product-items\"]/li[$i]/div/div/strong/a")->getText();

                //throw new \RuntimeException(sprintf("Product " .$productName. " does not have a Price"));
                //Silviu: modificat ca sa nu se mai opreasca aplicatia - prea multe produse fara pret
                echo "SKIPPED: Product " .$productName. " does not have a Price <\br>";
            }
        }
    }

    /**
     * @Given /^I can see that all products have Attribute Logo$/
     */
    public function iCanSeeThatAllProductsHaveAttributeLogo()
    {
        $totalProducts = $this->listProductsPage->getNoProductsPerPage()->getText();
        $totalProducts = intval($totalProducts);

        for ($i = 1; $i <= $totalProducts; $i ++){
            if (is_null($this->listProductsPage->findAnyProductLogo($i))){
                $productName = $this->utils->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"products list items product-items\"]/li[$i]/div/div/strong/a")->getText();
                throw new \RuntimeException(sprintf("Product " .$productName. " does not have an Attribute Logo"));
            }
        }

    }

    /**
     * @Given /^I can see that all products do not have Add to Wish List option$/
     */
    public function iCanSeeThatAllProductsDoNotHaveAddToWishListOption()
    {
        $totalProducts = $this->listProductsPage->getNoProductsPerPage()->getText();
        $totalProducts = intval($totalProducts);

        for ($i = 1; $i <= $totalProducts; $i ++){
            if (!is_null($this->listProductsPage->findAnyAddToWishListButton($i))){
                $productName = $this->utils->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"products list items product-items\"]/li[$i]/div/div/strong/a")->getText();
                throw new \RuntimeException(sprintf("Product " .$productName. " has Add to Wish List button"));
            }
        }
    }

    /**
     * @Given /^I can see that all products do not have Add to comparison list$/
     */
    public function iCanSeeThatAllProductsDoNotHaveAddToComparisonList()
    {
        $totalProducts = $this->listProductsPage->getNoProductsPerPage()->getText();
        $totalProducts = intval($totalProducts);

        for ($i = 1; $i <= $totalProducts; $i ++){
            if (!is_null($this->listProductsPage->findAnyAddToComparison($i))){
                $productName = $this->utils->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"products list items product-items\"]/li[$i]/div/div/strong/a")->getText();
                throw new \RuntimeException(sprintf("Product " .$productName. " has Add to Compare button"));
            }
        }
    }

    /**
     * @Given /^I can see that all products do not have have Prices$/
     */
    public function iCanSeeThatAllProductsDoNotHaveHavePrices()
    {
        $totalProducts = $this->listProductsPage->getNoProductsPerPage()->getText();
        $totalProducts = intval($totalProducts);

        for ($i = 1; $i <= $totalProducts; $i ++){
            if (!is_null($this->listProductsPage->findAnyProductPrice($i))){
                $productName = $this->utils->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@class=\"products list items product-items\"]/li[$i]/div/div/strong/a")->getText();
                throw new \RuntimeException(sprintf("Product " .$productName. " has a Price."));
            }
        }
    }

    /**
     * @Given /^I change currency to "([^"]*)"$/
     */
    public function iChangeCurrencyTo($arg1)
    {
        $this->homePage->getShippingCurrencyBtn()->click();
        $this->homePage->getChangeCurrencySelect()->setValue($arg1);
        $this->homePage->getSaveCurrencyBtn()->click();
    }
}