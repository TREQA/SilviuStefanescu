Feature: Verify that an anonymus user can add to cart and check "My cart"
  In order to buy products
  As an anonymous user
  I must be able to add to my cart

  @javascript @insulated
  Scenario: Empty Cart
    Given I am an anonymous user
    When I click on My Cart
    Then the message "You have no items in your shopping cart." will be shown.

  @javascript @insulated
  Scenario: Adding product to My Cart
    Given I am an anonymous user
    When I click on a product
    And I click on add to cart
    Then a number is added next to my cart based on product quantities
    And a confirmation message is shown

  @javascript @insulated
  Scenario: Details on product added to My Cart
    Given I am an anonymous user
    When I click on a product
    And I click on add to cart
    Then I click on My Cart
    And I see the number of items
    And I see the Cart Subtotal
    And I see the Go to Checkout option
    And I see the Edit item button
    And I see the Delete item button
    And I see the View and edit card link

  @javascript @insulated
  Scenario: Verify that add to cart is shown on the listing page
    Given I am an anonymous user
    When I add to cart the "TestAutoDeviceProd" product from listing page
    Then a number is added next to my cart based on product quantities
    And a confirmation message is shown

