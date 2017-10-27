Feature: Approve Seller product
  In order for seller products to be shown on website
  As an admin
  I must be able to approve them

  @javascript @insulated
  Scenario: Verify that an admin can approve a product created by a seller
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    And I complete all the mandatory fields for the product
    Then I click on Save
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    And the product status is disabled
    Then I change the product status to enabled and save
    And product is now enabled

  @javascript @insulated
  Scenario: Verify that admin can approve advanced pricing
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    And I complete all the mandatory fields for the advanced pricing product
    And I click on Save
    And a confirmation message appears regarding product creation
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    Then I click on Advanced Pricing
    And all the advanced pricing settings are setup properly
    Then I close the pop-up
    And I change the product status to enabled and save
    Then product is now enabled

  @javascript @insulated
  Scenario: Vendor: Verify that categories are added to a product, based on Product Attributes and Solution Represented from Content
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    Then I complete all the mandatory fields for the product
    And as a seller I select the Product Attributes and Solutions Represented
    And I click on Save
    Then a confirmation message appears regarding product creation
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    Then I change the product status to enabled and save
    And Categories are added based on the selected Product Attributes and Solutions Represented