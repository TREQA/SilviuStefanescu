Feature: Login feature
  In order to login on https://market.preprod.thingpark.com
  As a buyer
  I need to use valid credentials

  @javascript @insulated
  Scenario: Verify that a Buyer can login with valid credentials
    Given I am a buyer and I write in my username "automated@testactility3.com" and password "Password@123"
    When I click sign in button
    Then I will be logged in and see "My Dashboard"

  @javascript @insulated
  Scenario: Verify that a Buyer cannot login with valid username and invalid password
    Given I am a buyer and I write in my correct username and wrong password
    When I click sign in button
    Then I am not logged in and a message is shown regarding invalid credentials

  @javascript @insulated @debugish
  Scenario: Verify that Buyer password is case sensitive UpperCase
    Given I am a buyer and I write in my correct username and password with lowercase
    When I click sign in button
    Then I am not logged in and a message is shown regarding invalid credentials

  @javascript @insulated
  Scenario: Verify that Buyer password is case sensitive LowerCase
    Given I am a buyer and I write in my correct username and password with uppercase
    When I click sign in button
    Then I am not logged in and a message is shown regarding invalid credentials



