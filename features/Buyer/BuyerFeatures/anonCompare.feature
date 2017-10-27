Feature: Verify that an anonymous user can add to compare
  In order to compare products
  As an anonymous user
  I must be able to add to compare

  @javascript @insulated @add_compare
  Scenario: Add to compare "Device" products
    Given I am an anonymous user
    And I click on Devices
    And I click on product Add to Compare icon
    Then The confirmation message will be shown.
