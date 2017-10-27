Feature: Register a Seller account
  In order to become a seller
  As an anonymous user
  I must be able to register on seller's portal


  @javascript @insulated
  Scenario: Verify that Seller Register page has all required content present
    Given I am an anonymus user
    When I click on become a seller
    Then I will be redirected to seller login page
    And I click on Register New Account
    Then I am redirected to register page and all necessary fields are present

  @javascript @insulated
  Scenario: Verify that mandatory fields are marked properly when not completed during Seller registration
    Given I am an anonymus user
    When I click on become a seller
    Then I will be redirected to seller login page
    And I click on Register
    Then All mandatory fields will be highlighted properly


