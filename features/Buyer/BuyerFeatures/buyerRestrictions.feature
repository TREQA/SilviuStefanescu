Feature: Buyer Restrictions for certain actions
  In order to restrict some functionality
  As a buyer
  I must not be able to do certain actions


  @javascript @insulated
  Scenario: Verify that an admin can add a product without a unit price / search listing
    Given I am logged in as "buyer"
    And I search for "NoPriceAutoProduct";
    Then No price is present for the product
    And Out of stock label is not shown
    And Add to cart button is not present

  @javascript @insulated
  Scenario: Verify that an admin can add a product without a unit price / product details
    Given I am logged in as "buyer"
    And I search for "AutomatedNoPriceProd";
    When I click on first search result
    Then Price is not shown in product details
    And Out of stock is not shown in product details
    And Add to cart button is not present in product details
    And VAt excluded is not shown in product details
    And Notify me when this product is in stock option is not present
    And Notify me when the price drops option is not present