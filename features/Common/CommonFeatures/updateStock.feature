Feature: Update Stock as Seller
  In order for my products to be bough
  As a seller
  i must be able to update the products stock

  @javascript @insulated
  Scenario: Verify that a seller can update stock
    Given I am logged in as "seller"
    And I go to Product Manager page
    Then I add a new "Device" product
    And I complete all the mandatory fields for the product
    And I click on Save
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    Then I change the product status to enabled and save
    Given I am a logged in "seller"
    And I go to Product Manager page
    And I search for the previously added product
    Then the product is out of stock
    And I go to Stock menu
    And I search for the product stock
    Then I add stock qty and change the status to In stock
    And I go to Product Manager page
    And I search for the previously added product
    And the product is in stock