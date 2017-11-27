
Feature: Verify that an anonymus user can browse the website
  In order to use https://market.preprod.thingpark.com
  As an anonymous/buyer user
  I need to see website available content


  @javascript @insulated
  Scenario: Page Content Check
    Given I am an anonymus user
    When I go to to thingpark webpage
    Then I can see the link to "click here !"
    And I can see the search option
    And I can see the logo
#    And I can see "My Account" to be continued
#    And I can see "My Cart"
#    And I can see "buy now" button

  @javascript @insulated
  Scenario: Verify that a visitor can see "terms of use" block when they first access website and it disappears after accepting it (pop-up shows)
    Given I am an anonymus user
    Then a pop-up is shown with Terms of use
    And I click on read more button
    Then I am redirected to Privacy Policy Page
    And I click on OK
    Then the pop-up disappears

  @javascript @insulated
  Scenario: Verify that an anonymus user can see and access menu
    Given I am an anonymous user
    Then I can access the Menu Options

  @javascript @insulated @wednesday
  Scenario: Verify that a logged in buyer can see products from multiple vendors
    Given I am logged in as "buyer"
    And I click on "Devices" menu option
    Then I select "Seller" from Filtering Options
    And I click on "EUROCOMPOSANT" Seller from Sub Filtering Option
    And I click on show "all" items per page
    Then I should see only products from Automated Listing Vendor

  @javascript @insulated
  Scenario: Verify that an user can access advanced search feature
    Given I am logged in as "buyer"
    When I write "test" in search field
    And I click on Advanced Search
    Then Advanced Search popup should appear
    And I verify that the required fields are shown for the popup
    Given I complete all fields with random data
    And I press search
    Then No Advanced Search items are found
    Given I click on Modify your search button
    Then Advanced Search popup should appear
    And I complete some fields with relevant data
    When I press search
    Then products are shown
    And I click on Modify your search button
    Then Advanced Search popup should appear

  @javascript @insulated
  Scenario: Verify that an anonymus user has access to listing pages from the menu
    Given I am an anonymous user
    When I click on "Devices" menu option
    Then I am on "Devices" page
    And I can see the Breadcrumbs as "Devices"
    And I can see the page title is "Devices"
    And I can see the Filtering options
    And I can see the Sort By option
    And I can see the ascending/descending sorting option
    And I can see the Pagination elements
    And I can see the Show "n" products per page option
    And I can see the Wish List Area
    When I click on "Gateways" menu option
    Then I am on "Gateways" page
    And I can see the page description
    And I can see the Breadcrumbs as "Gateways"
    And I can see the page title is "Gateways"
    And I can see the Filtering options
    And I can see the Sort By option
    And I can see the ascending/descending sorting option
    And I can see the Pagination elements
    And I can see the Show "n" products per page option
    And I can see the Wish List Area
    When I click on "ThingPark Connected" menu option
    Then I am on "ThingPark Connected" page
    And I can see the page description
    And I can see the Breadcrumbs as "ThingPark Connected"
    And I can see the page title is "ThingPark Connected"
    And I can see the Filtering options
    And I can see the Sort By option
    And I can see the ascending/descending sorting option
    And I can see the Pagination elements
    And I can see the Show "n" products per page option
    And I can see the Wish List Area
    When I click on "Solutions" menu option
    Then I am on "Solutions" page
    And I can see the Breadcrumbs as "Solutions"
    And I can see the page title is "Solutions"
    And I can see the Filtering options
    And I can see the Sort By option
    And I can see the ascending/descending sorting option
    And I can see the Pagination elements
    And I can see the Show "n" products per page option
    And I can see the Wish List Area
    When I click on "Sellers" menu option
    Then I am on "Sellers" page
    And I can see the Breadcrumbs as "Sellers"
    And I can see the page title is "Sellers"
    And I can see the Filtering options
    And I can see the Sort By option
    And I can see the ascending/descending sorting option
    And I can see the Pagination elements
    And I can see the Show "n" products per page option
    And I can see the Wish List Area

  @javascript @insulated
  Scenario: Verify that an anonymus user can access content on each listing page
    Given I am an anonymous user
    When I click on "Devices" menu option
    Then I am on "Devices" page
    Then I click on show "all" items per page
    And I can see that all products have Add to Wish List option
    And I can see that all products have Add to comparison list
    And I can see that all products have Images
    And I can see that all products have Titles
    And I can see that all products have Prices
    And I can see that all products have Attribute Logo
    When I click on "Gateways" menu option
    Then I am on "Gateways" page
    Then I click on show "all" items per page
    And I can see that all products have Add to Wish List option
    And I can see that all products have Add to comparison list
    And I can see that all products have Images
    And I can see that all products have Titles
    And I can see that all products have Prices
    And I can see that all products have Attribute Logo
    When I click on "ThingPark Connected" menu option
    Then I am on "ThingPark Connected" page
    Then I click on show "all" items per page
    And I can see that all products have Add to Wish List option
    And I can see that all products have Add to comparison list
    And I can see that all products have Images
    And I can see that all products have Titles
    And I can see that all products have Prices
    And I can see that all products have Attribute Logo
    When I click on "Solutions" menu option
    Then I am on "Solutions" page
    Then I click on show "all" items per page
    And I can see that all products have Add to Wish List option
    And I can see that all products have Add to comparison list
    And I can see that all products have Images
    And I can see that all products have Titles
    And I can see that all products have Prices
    And I can see that all products have Attribute Logo
    When I click on "Sellers" menu option
    Then I am on "Sellers" page
    Then I click on show "all" items per page
    And I can see that all products do not have Add to Wish List option
    And I can see that all products do not have Add to comparison list
    And I can see that all products have Images
    And I can see that all products have Titles
    And I can see that all products do not have have Prices
    And I can see that all products have Attribute Logo

  @javascript @insulated
  Scenario:Verify that a logged in buyer can access content on each listing page
    Given I am logged in as "buyer"
    When I click on "Devices" menu option
    Then I am on "Devices" page
    Then I click on show "all" items per page
    And I can see that all products have Add to Wish List option
    And I can see that all products have Add to comparison list
    And I can see that all products have Images
    And I can see that all products have Titles
    And I can see that all products have Prices
    And I can see that all products have Attribute Logo
    When I click on "Gateways" menu option
    Then I am on "Gateways" page
    Then I click on show "all" items per page
    And I can see that all products have Add to Wish List option
    And I can see that all products have Add to comparison list
    And I can see that all products have Images
    And I can see that all products have Titles
    And I can see that all products have Prices
    And I can see that all products have Attribute Logo
    When I click on "ThingPark Connected" menu option
    Then I am on "ThingPark Connected" page
    Then I click on show "all" items per page
    And I can see that all products have Add to Wish List option
    And I can see that all products have Add to comparison list
    And I can see that all products have Images
    And I can see that all products have Titles
    And I can see that all products have Prices
    And I can see that all products have Attribute Logo
    When I click on "Solutions" menu option
    Then I am on "Solutions" page
    Then I click on show "all" items per page
    And I can see that all products have Add to Wish List option
    And I can see that all products have Add to comparison list
    And I can see that all products have Images
    And I can see that all products have Titles
    And I can see that all products have Prices
    And I can see that all products have Attribute Logo
    When I click on "Sellers" menu option
    Then I am on "Sellers" page
    Then I click on show "all" items per page
    And I can see that all products do not have Add to Wish List option
    And I can see that all products do not have Add to comparison list
    And I can see that all products have Images
    And I can see that all products have Titles
    And I can see that all products do not have have Prices
    And I can see that all products have Attribute Logo
