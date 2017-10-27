Feature: Vendor Creating Editing
  In order to administrate the website
  As an admin
  I must be able to configure Vendors

  @javascript @insulated @debug
  Scenario: Verify - create/ edit a Vendor
    Given I am logged in as "admin"
    And I go to Vendor page
    And I add a New Vendor
    Then The vendor is created with the details i entered
    And I Edit the created vendor
    And I save the changes made to vendor account
    Then I check that changes have been saved

  @javascript @insulated @debug
  Scenario: Verify - add a product for the vendor
    Given I am logged in as "admin"
    And I go to Vendor page
    And I add a New Vendor
    Then I go to Products Catalog page
    And I click on add product
    And I create a product for the previously created vendor
    Then I go to Vendor page
    And I click on view on the created vendor
    And I check that the product is added to the vendor

  @javascript @insulated @debug
  Scenario: Verify that option "Require admin approval for vendor-customer communication" is present in vendors
    Given I am logged in as "admin"
    When I go to Sales > Vendors page
    And I Edit a Vendor
    Then Require admin approval for vendor-customer communication dropdown is present with options Yes and No


