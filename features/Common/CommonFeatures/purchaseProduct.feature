Feature: Purchasing products
  In order to make use of the e-commerce application
  As a buyer
  I must be able to purchase products

  @javascript @insulated
  Scenario: Verify that an order created by buyer, through HIPAY does not need a PO from admin
    Given I am logged in as "buyer"
    And I have an empty Cart
    When I add to cart the "TestAutoDeviceProd" product from listing page
    Then I click on My Cart
    And I click on Go to Checkout button
    Then I click on Proceed to Checkout
    And I click on Next
    Then I chose to pay via Credit Card
    And I agree to the terms and conditions for the seller and ThinkPark
    Then I click on "Continue to Hipay"
    And I complete my "CB" credit card details
    Then I click on pay
    And payment is successful
    Given I am logged in as "seller"
    When I go to Seller's Orders page
    Then I search for the order with PO created
    And The order is found in "Pending" Status

  @javascript @insulated
  Scenario: As a Seller I can see an order payed via Bank Transfer after Admin assigned PO number to it
    Given I am logged in as "buyer"
    And I have an empty Cart
    When I add to cart the "TestAutoDeviceProd" product from listing page
    Then I click on My Cart
    And I click on Go to Checkout button
    Then I click on Proceed to Checkout
    And I click on Next
    Then I chose to pay via Bank Transfer Payment
    And I agree on the terms and conditions for the seller and ThinkPark
    Then I click on "Place Order"
    And Order has been placed successfully
    Given I am logged in as "admin"
    When I go to Orders page
    And I search for the order previously created by the buyer
    Then I view the order
    And I click on Create Po
    Then I create the Po
    Given I am logged in as "seller"
    When I go to Seller's Orders page
    Then I search for the order with PO created
    And The order is found in "Pending" Status