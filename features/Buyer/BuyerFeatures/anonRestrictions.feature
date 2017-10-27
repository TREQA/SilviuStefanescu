Feature: Check Anonymous users restrictions
  In order access some of the website functionality
  As an anonymous user
  I must be prompted to login or create a new account

  @javascript @insulated
  Scenario: Verify that an anonymus user cannot add to wishlist
    Given I am an anonymous user
    And I add to wishlist the "AutoListingCartProduct" product from listing page
    Then I am prompted to login or Create a new account

  @javascript @insulated
  Scenario: Verify that an anonymus user cannot add to wishlist via product details
    Given I am an anonymous user
    And I click on a product
    And I add it to favorite
    Then I am prompted to login or Create a new account

  @javascript @insulated
  Scenario: Verify that an anonymus user can add to cart and when they go to checkout they are prompted to create a new user or log in
    Given I am an anonymous user
    And I click on a product
    Then I click on add to cart
    And I click on My Cart
    And I click on Go to Checkout button
    Then I am prompted to checkout as a new customer or checkout using an existing account

  @javascript @insulated
  Scenario: Verify that an anonymus user can add to cart and when they go to View and Edit and then checkout they are prompted to create a new user or log in
    Given I am an anonymous user
    And I click on a product
    Then I click on add to cart
    And I click on My Cart
    And I click on View and Edit
    And I click on Proceed to Checkout
    Then I am prompted to checkout as a new customer or checkout using an existing account

  @javascript @insulated
  Scenario: Verify that a visitor is not able to download PDF's from products, but is prompted to log in in order to perform action
    Given I am an anonymous user
    And I search for "QABASIC TESTING PRODUCT 2 PDF CREATION";
    Then I click on first search result
    And I click on technical doc pdf link
    Then A pop-up appears to login or Create a new account in order to view content

  @javascript @insulated
  Scenario: Verify that an admin can add a product without a unit price / search listing
    Given I am an anonymus user
    And I search for "AutomatedNoPriceProd";
    Then No price is present for the product
    And Out of stock label is not shown
    And Add to cart button is not present

  @javascript @insulated
  Scenario: Verify that an admin can add a product without a unit price / product details
    Given I am an anonymous user
    And I search for "AutomatedNoPriceProd";
    When I click on first search result
    Then Price is not shown in product details
    And Out of stock is not shown in product details
    And Add to cart button is not present in product details
    And VAt excluded is not shown in product details
    And Notify me when this product is in stock option is not present
    And Notify me when the price drops option is not present