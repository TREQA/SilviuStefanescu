Feature: Enabling and Disabling products
  In order to temporary remove products from buyer's website
  As a seller
  I must be able to Disable and Enable products

  @javascript @insulated
  Scenario: Admin: Verify that a Seller can enable/disable products
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    Then I complete all the mandatory fields for the product
    And I click on Save
    And a confirmation message appears regarding product creation
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    Then I change the product status to enabled and save
    Given I am a logged in "seller"
    When I go to Product Manager page
    And I "disable" the previously added "Device" product
    Then "disable" message is shown
#    And admin receives email regarding product being "disabled"
    Given I am a logged in "admin"
    When I go to Products Catalog page
    And I search for the previously added product by seller
    Then the product status is "Disabled"
    Given I am a logged in "seller"
    When I go to Product Manager page
    And I "enable" the previously added "Device" product
    Then "enable" message is shown
#    And admin receives email regarding product being "enabled"
    Given I am a logged in "admin"
    When I go to Products Catalog page
    And I search for the previously added product by seller
    Then the product status is "Pending"

  @javascript @insulated
  Scenario: Admin: Verify that a Seller can enable/disable products
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    Then I complete all the mandatory fields for the product
    And I click on Save
    And a confirmation message appears regarding product creation
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    Then I change the product status to enabled and save
    Given I am a logged in "seller"
    When I go to Product Manager page
    And I "disable" the previously added "Device" product
    Then "disable" message is shown
    Given I am logged in as "buyer"
    When I search for the "disabled" product
    Then No results are found
    Given I am a logged in "seller"
    When I go to Product Manager page
    And I "enable" the previously added "Device" product
    Then "enable" message is shown
    Given I am a logged in "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    Then I change the product status to enabled and save
    Given I am a logged in "buyer"
    When I search for the "enabled" product
    Then Product is found

  @javascript @insulated
  Scenario: Admin: Verify that a Seller can enable/disable products
    Given I am logged in as "seller"
    When I go to Product Manager page
    And I add a new "Device" product
    Then I complete all the mandatory fields for the product
    And I click on Save
    Then a confirmation message appears regarding product creation
    And I search for the previously added product
    Then Disable and Enable buttons are not present for the created product
    And System Status, Stock Status and Stock Qty values are "Under Review"
    Given I am logged in as "admin"
    When I go to Products Catalog page
    And I edit the product created by the seller
    Then I change the product status to enabled and save
    Given I am a logged in "seller"
    When I go to Product Manager page
    And I search for the previously added product
    Then Disable button is present and Enable button is not for the created product
    And System Status is "Published"
    Then I click on "disable" for the previously added product
    And alert pops up regarding "disabling" product
    Then I accept the alert
    And "disable" message is shown
    Then Enable button is present and Disable button is not for the created product
    And System Status, Stock Status and Stock Qty values are "Disabled"
    Then I click on "enable" for the previously added product
    And alert pops up regarding "enabling" product
    Then I accept the alert
    And "enable" message is shown
    Then Disable and Enable buttons are not present for the created product
    And System Status, Stock Status and Stock Qty values are "Under Review"

