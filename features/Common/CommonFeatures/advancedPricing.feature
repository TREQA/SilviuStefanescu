Feature: Advanced Pricing Display
  In order to make use of the price/qty offers
  As a buyer
  I must see the advanced pricing options

  @javascript @insulated
  Scenario: Verify that buyer/visitor can see value based pricing on the listing pages / buyer listing
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    And I complete all the mandatory fields for the advanced pricing product
    And I click on Save
    And a confirmation message appears regarding product creation
    Then I go to Stock menu
    And I search for the product stock
    And I add stock qty and change the status to In stock
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    And I change the product status to enabled and save
    Given I am logged in as "buyer"
    And I change currency to "EUR"
    When I search for the advanced pricing product
    Then I see the advanced pricing information

  @javascript @insulated
  Scenario: Verify that buyer/visitor can see value based pricing on the listing pages / buyer details
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    And I complete all the mandatory fields for the product
    Then I add advanced pricing settings
    And I click on Save
    And a confirmation message appears regarding product creation
    Then I go to Stock menu
    And I search for the product stock
    And I add stock qty and change the status to In stock
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    And I change the product status to enabled and save
    Given I am logged in as "buyer"
    And I change currency to "EUR"
    When I search for an advanced pricing product
    And I click on first search result
    Then I see the detailed advanced pricing information


  @javascript @insulated
  Scenario: Verify that buyer/visitor can see value based pricing on the listing pages / visitor listing
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    And I complete all the mandatory fields for the product
    Then I add advanced pricing settings
    And I click on Save
    And a confirmation message appears regarding product creation
    Then I go to Stock menu
    And I search for the product stock
    And I add stock qty and change the status to In stock
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    And I change the product status to enabled and save
    Given I am an anonymous user
    And I change currency to "EUR"
    When I search for the advanced pricing product
    Then I see the advanced pricing information

  @javascript @insulated
  Scenario: Verify that buyer/visitor can see value based pricing on the listing pages / visitor details
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    And I complete all the mandatory fields for the product
    Then I add advanced pricing settings
    And I click on Save
    And a confirmation message appears regarding product creation
    Then I go to Stock menu
    And I search for the product stock
    And I add stock qty and change the status to In stock
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    And I change the product status to enabled and save
    Given I am an anonymous user
    And I change currency to "EUR"
    When I search for an advanced pricing product
    And I click on first search result
    Then I see the detailed advanced pricing information
