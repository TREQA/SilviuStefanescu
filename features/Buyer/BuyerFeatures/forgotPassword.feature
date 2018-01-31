Feature: Verify functionality " forgot password" for a buyer.
  In order to login as a buyer
  As an existing user
  I must be able to recover my password

  @javascript @insulated
  Scenario: Invalid credentials
    Given I am a buyer and I write in my username "sdferafg@gmail.com" and password "anotherwrongpassword"
    When I click sign in button
    Then I am notified that username or password is invalid

  @javascript @insulated
  Scenario: Forgot Password Cancel Button
    Given I am an anonymous user
    And I go to to myAccount page
    When I click on forgot password button
    Then I am redirected to password recovery
    And I enter the e-mail and captcha
    And I click cancel
    Then E-mail and captcha fields are emptied