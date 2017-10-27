Feature: Login feature
  In order to login on https://market.preprod.thingpark.com
  As a seller
  I need to use valid credentials

  @javascript @insulated
  Scenario: Verify that a Seller can login with valid credentials
    Given I am a seller and I write in my username "something@something.com" and password "Password@123"
    When I click seller sign in button
    Then I will be logged in and see the "Orders"

  @javascript @insulated
  Scenario: Verify that a Seller cannot login with valid username and invalid password
    Given I am a seller and I write in my valid username and invalid password
    When I click seller sign in button
    Then I will be on login page and a message regarding invalid credentials is shown

  @javascript @insulated
  Scenario: Verify that a Seller password is case sensitive UpperCase
    Given I am a seller and I write in my valid username and valid password with lowercase
    When I click seller sign in button
    Then I will be on login page and a message regarding invalid credentials is shown

  @javascript @insulated
  Scenario: Verify that a Seller password is case sensitive LowerCase
    Given I am a seller and I write in my valid username and valid password with uppercase
    When I click seller sign in button
    Then I will be on login page and a message regarding invalid credentials is shown