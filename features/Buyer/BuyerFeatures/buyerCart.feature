Feature: Verify that a logged in buyer can add products to cart
  In order to buy products
  As a buyer user
  I must be able to add to my cart

  @javascript @insulated
  Scenario: Empty Cart
    Given I am logged in as "buyer"
    And I have an empty Cart
    Then the message "You have no items in your shopping cart." will be shown.

  @javascript @insulated
  Scenario: Adding product to My Cart
    Given I am logged in as "buyer"
    And I have an empty Cart
    When I add to cart the "TestAutoDeviceProd" product from listing page
    Then a number is added next to my cart based on product quantities
    And A confirmation message is shown

  @javascript @insulated
  Scenario: Details on product added to My Cart
    Given I am logged in as "buyer"
    And I have an empty Cart
    When I add to cart the "TestAutoDeviceProd" product from listing page
    Then I click on My Cart
    And I see the number of items
    And I see the Cart Subtotal for buyer
    And I see the Go to Checkout option
    And I see the Edit item button
    And I see the Delete item button
    And I see the View and edit card link

  @javascript @insulated
  Scenario: Verify that add to cart is shown on the listing page
    Given I am logged in as "buyer"
    And I have an empty Cart
    When I add to cart the "TestAutoDeviceProd" product from listing page
    Then a number is added next to my cart based on product quantities
    And a confirmation message is shown
