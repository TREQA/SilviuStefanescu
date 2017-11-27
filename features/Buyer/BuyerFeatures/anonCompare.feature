Feature: Verify that an anonymous user can add products to compare
  In order to compare products
  As an anonymous user
  I must be able to add products to compare

  @javascript @insulated
  Scenario: Verify that an anonymus user can add to compare
    Given I am an anonymous user
    When I click on "Devices" page
    And I click on products Add to Compare icon
    Then The confirmation message will be shown.
    And  Compare Products link with counter is updated
