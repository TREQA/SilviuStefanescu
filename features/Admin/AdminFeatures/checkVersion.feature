Feature: Check version on admin page
  In order to check application version number
  As an admin
  I need to see app version after I login

  @javascript @insulated
  Scenario: Verify that deployed version is existent in admin
    Given I am an admin and I write in my username "madalina.admin" and password "Madalina12"
    When I click admin sign in button
    Then I will be logged in and will see version number

