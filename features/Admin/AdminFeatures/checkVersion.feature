Feature: Check version on admin page feature
  In order to check version number
  As an admin
  I need to login

  @javascript @insulated  @check_version
  Scenario: Verify - login as admin
    Given I am an admin and I write in my username "madalina.admin" and password "Madalina12"
    When I click admin sign in button
    Then I will be logged in and will see version number "app ver. 2.0.0"

