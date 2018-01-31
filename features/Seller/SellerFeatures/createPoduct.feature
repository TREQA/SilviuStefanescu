  Feature: Create Product as a seller
  In order to add products tot he website
  As a seller
  I must be able to create products

  @javascript @insulated
  Scenario: Verify that a seller is able to create a product
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    Then I see the add product page information
    And I complete all the mandatory fields for the product
    And I click on Save
    Then a confirmation message appears and the product is created

  @javascript @insulated
  Scenario: Verify that vendor can set advanced pricing
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    And I complete all the mandatory fields for the advanced pricing product
    And I click on Save
    And a confirmation message appears and the product is created
    Then I edit the advanced pricing product
    And I check that the advanced pricing settings have been saved

  @javascript @insulated
  Scenario: Verify that seller can add product and he can edit/delete while in review /edit
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    Then I complete all the mandatory fields for the product
    And I click on Save
    Then a confirmation message appears regarding product creation
    And I search for the previously added product
    Then System Status, Stock Status and Stock Qty values are "Under Review"
    And I edit the product that is Under review
    Then I edit the product price
    And I click on Save
    Then I search for the previously added product
    And I edit the product that is Under review
    Then check that the edited price has been saved
    And I search for the previously added product
    Then I delete the product that is under review
    And I search for the previously added product
    Then product is not found