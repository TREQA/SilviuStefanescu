Feature: The product URL must be displayed properly
  In order for the URL to display proper information
  As a Buyer/Anonymous
  I must see the product URL respecting the following rules: Domain+Category+Sub-category+Product name based on ids

  @javascript @insulated
  Scenario: Admin:Verify URL of the products to be Domain+Category+Sub-category+Product name based on ids /buyer
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I click on add product
    Then I set all the mandatory fields for the product
    And I select "Device" Attribute Set and click on Content Section
    Then I select the Product Attributes and Solutions Represented
    And I click on Save button
    Then Product is saved
    Given I am logged in as "buyer"
    When I search for the product with the specific attributes created by the admin
    And I click on first search result
    Then the product details URL has proper format

  @javascript @insulated
  Scenario: Vendor:Verify URL of the products to be Domain+Category+Sub-category+Product name based on ids / buyer
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
    And Product is saved
    Given I am logged in as "buyer"
    When I search for the product with the specific attributes created by the seller
    And I click on first search result
    Then the product details URL has proper format when added by seller

  @javascript @insulated
  Scenario: Admin:Verify URL of the products to be Domain+Category+Sub-category+Product name based on ids / anonymous
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I click on add product
    Then I set all the mandatory fields for the product
    And I select "Device" Attribute Set and click on Content Section
    Then I select the Product Attributes and Solutions Represented
    And I click on Save button
    Then Product is saved
    Given I am an anonymus user
    When I search for the product with the specific attributes created by the admin
    And I click on first search result
    Then the product details URL has proper format

  @javascript @insulated
  Scenario: Vendor:Verify URL of the products to be Domain+Category+Sub-category+Product name based on ids / anonymous
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
    And Product is saved
    Given I am an anonymus user
    When I search for the product with the specific attributes created by the seller
    And I click on first search result
    Then the product details URL has proper format when added by seller