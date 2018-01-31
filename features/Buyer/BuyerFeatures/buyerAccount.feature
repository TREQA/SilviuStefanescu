Feature: Create Account Feature
  In order to login with a new account
  As an anonymous user
  I must be able to create a new account and use it

  @javascript @insulated
  Scenario: Verify that an anonymus user can create a buyer account
    Given I am an anonymous user
    When I go to to myAccount page
    And I click on Create an Account
    Then I am redirected to account creation page
    And I put in my account information
    And I click on create account
    Then I will see confirmation
    And I will be logged in and see "My Dashboard"

  @javascript @insulated
  Scenario: Verify that a newly created user can log in as a buyer
    Given I am an anonymous user
    When I go to to myAccount page
    And I input my newly created username and password
    When I click sign in button
    Then I will be logged in and see "My Dashboard"

  @javascript @insulated
  Scenario: Verify that a logged in buyer can change his password from my account.
    Given I am an anonymous user
    When I go to to myAccount page
    And I input my newly created username and password
    When I click sign in button
    And I go to "Account Information" page
    Then I check the change password box
    And I change my password and save
    Then I will see update confirmation message "You saved the account information."
    And I logout
    When I input my new credentials
    And I click sign in button
    Then I will be logged in and see "My Dashboard"

  @javascript @insulated
  Scenario: Verify that a logged in buyer cannot login with an old password
    Given I am an anonymous user
    When I go to to myAccount page
    And I input my old password
    And I click sign in button
    Then I am notified that username or password is invalid

  @javascript @insulated @repairing
  Scenario: Verify that a logged in buyer can change his account information
    Given I am an anonymous user
    When I go to to myAccount page
    And I input my newly created username and changed password
    Then I click sign in button
    And I click on Edit button from My Account information
    Then I am redirected to "Edit Account Information" page
    And I check the change e-mail box
    And I change my account information
    And I save the changes
    Then I will see update confirmation message "You saved the account information."
    And I logout
    When I input my new e-mail and password
    And I click sign in button
    And I click on Edit button from My Account information
    And I check the change e-mail box
    Then I will see my updated information



