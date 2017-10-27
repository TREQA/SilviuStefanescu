Feature: Product manipulation from admin site
  In order to administrate the website
  As an admin
  I must be able to configure products to buyer website

  @javascript @insulated
  Scenario: Verify that an admin can add a product without a unit price
    Given I am logged in as "admin"
    And I go to Products Catalog page
    And I click on Add > Product - No price button
    Then I complete all mandatory fields for no price product
    And I click on Save button
    And Product is saved
    When I am logged in as "buyer"
    And I search for the product created by the admin
    Then I find the product

  @javascript @insulated
  Scenario: Verify that an admin cannot see "unit price" field when approving a product created by a vendor
    Given I am logged in as "seller"
    And I go to Product Manager page
    And I add a new "Product - No Price" product
    Then I complete all mandatory fields for a product with no price and save
    When I am logged in as "admin"
    When I go to Products Catalog page
    And I search for the previously added product by seller
    Then the product will have no price
    And I edit the product
    Then Price is not shown for the product

