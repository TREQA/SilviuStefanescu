Feature: Login feature
  In order to login on http://www.brandradar.ro
  As an admin
  I need to use valid credentials

  @javascript @insulated @brandradar
  Scenario: Verify - login as admin
    Given I am an admin and I write in my username "elsilviu" and password "887663"
    When I click admin sign in button
    Then I will be logged in and see my "BrandRadar Admin Dashboard"

#  @javascript @insulated @debugish2
#  Scenario: Verify that Admin password is case sensitive UpperCase
#    Given I am a "admin" and I write in my correct username and password with lowercase
#    When I click admin sign in button
#    Then I am not logged in as an admin and a message is shown regarding invalid credentials
