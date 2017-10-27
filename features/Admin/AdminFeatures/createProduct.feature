Feature: Product manipulation from admin site
  In order to administrate the website
  As an admin
  I must be able to configure products

  @javascript @insulated deprecated
  Scenario: Verify that an admin can add a product without a unit price
#    Given I am logged in as "admin"
#    And I go to Products Catalog page
#    And I click on Add > Product - No price button
#    Then Unit Price field is not present
#    And Main Website box is checked
#    Then I complete all mandatory fields for no price product
#    And I click on Save button
#    Then Product is created and no errors are shown

#  Scenario: Verify that admin can add product
#    Given I am logged in as "admin"
#    And I go to Products Catalog page
#    When I click on add product
#    And I create a product with 2 categories and 4 subcategories
#    Then the product is saved with the specified details

  @javascript @insulated
  Scenario: Admin: Verify that categories are added to a product, based on Product Attributes and Solution Represented from Content
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I click on add product
    Then I set all the mandatory fields for the product
    And I select "Device" Attribute Set and click on Content Section
    And I select the Product Attributes and Solutions Represented
    When I click on Save button
    And Product is saved
    Then Categories are added based on the selected Product Attributes and Solutions Represented
