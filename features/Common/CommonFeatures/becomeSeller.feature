Feature: Becoming a seller
  In order to become a seller
  As an anonymous user
  I must be redirected to seller page after clicking on become a seller

  @javascript @insulated
  Scenario: Verify that an anonymous user can access link "become a seller"
    Given I am an anonymous user
    When I click on become a seller
    Then I will be redirected to seller login page

  @javascript @insulated
  Scenario: Verify that Seller Registration can be done successfully
    Given I am an anonymus user
    When I click on become a seller
    And I click on Register New Account
    Then I complete all the mandatory fields for seller registration
    And I click on Register
    Then a message regarding seller registration is displayed
    Given I am logged in as "admin"
    When I go to Vendor Registrations page
    And I search for the previously registered vendor
    Then I Edit the registered vendor
    And I activate the seller, set his password and save
    Then I login with the newly created vendor
    And I will be logged in and see the "Orders"

  @javascript @insulated
  Scenario: Verify that an admin can reject the registration application of a seller
    Given I am an anonymus user
    When I click on become a seller
    And I click on Register New Account
    Then I complete all the mandatory fields for seller registration
    And I click on Register
    Then a message regarding seller registration is displayed
    Given I am logged in as "admin"
    When I go to Vendor Registrations page
    And I search for the previously registered vendor
    Then I Edit the registered vendor
    And I reject the seller, set his password, the reason and save
    When I login with the newly created vendor
    Then Rejection message is displayed