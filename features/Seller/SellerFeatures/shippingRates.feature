Feature: Shipping Rates
  As a seller i need to be able to add/modify shipping rates

  @javascript @insulated
  Scenario: Verify that when saving rate without defining countries "all" countries are selected and option appears in "selected countries"
    Given I am logged in as "seller"
    And I go to Shipping Rates
    Then I select Standard Shipping
    And I click on "Africa" from Continents and Regions
    Then I click on ADD button
    And I select all countries from Selected Countries
    Then I click on Remove Button
    And I select "Full Weight" condition name
    Then I click on Add Condition
    And I complete all the fields for condition
    And I save shipping rates
    Then a confirmation message appears regarding rates
    And I select Standard Shipping
    Then Selected Countries field is "*** All ***"

  @javascript @insulated
  Scenario: Verify that seller can add multiple regions and continents and countries are preselcted
    Given I am logged in as "seller"
    And I go to Shipping Rates
    Then I select Express Shipping
    And I click on Add Rate button
    And I click on "Africa" from Continents and Regions
    And I click on ADD button
    Then "Africa" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Eastern Africa" from Continents and Regions
    And I click on ADD button
    Then "Eastern Africa" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Middle Africa" from Continents and Regions
    And I click on ADD button
    Then "Middle Africa" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Northern Africa" from Continents and Regions
    And I click on ADD button
    Then "Northern Africa" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Southern Africa" from Continents and Regions
    And I click on ADD button
    Then "Southern Africa" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Western Africa" from Continents and Regions
    And I click on ADD button
    Then "Western Africa" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Asia" from Continents and Regions
    And I click on ADD button
    Then "Asia" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Central Asia" from Continents and Regions
    And I click on ADD button
    Then "Central Asia" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Eastern Asia" from Continents and Regions
    And I click on ADD button
    Then "Eastern Asia" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Southern Asia" from Continents and Regions
    And I click on ADD button
    Then "Southern Asia" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "South Eastern Asia" from Continents and Regions
    And I click on ADD button
    Then "South Eastern Asia" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Western Asia" from Continents and Regions
    And I click on ADD button
    Then "Western Asia" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Europe" from Continents and Regions
    And I click on ADD button
    Then "Europe" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Eastern Europe" from Continents and Regions
    And I click on ADD button
    Then "Eastern Europe" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Northern Europe" from Continents and Regions
    And I click on ADD button
    Then "Northern Europe" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Southern Europe" from Continents and Regions
    And I click on ADD button
    Then "Southern Europe" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Western Europe" from Continents and Regions
    And I click on ADD button
    Then "Western Europe" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "North America" from Continents and Regions
    And I click on ADD button
    Then "North America" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Caribbean" from Continents and Regions
    And I click on ADD button
    Then "Caribbean" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Central America" from Continents and Regions
    And I click on ADD button
    Then "Central America" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Northern America" from Continents and Regions
    And I click on ADD button
    Then "Northern America" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "South America" from Continents and Regions
    And I click on ADD button
    Then "South America" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Oceania" from Continents and Regions
    And I click on ADD button
    Then "Oceania" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Australia and New Zealand" from Continents and Regions
    And I click on ADD button
    Then "Australia and New Zealand" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Melanesia" from Continents and Regions
    And I click on ADD button
    Then "Melanesia" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Micronesia" from Continents and Regions
    And I click on ADD button
    Then "Micronesia" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
    Then I click on "Polynesia" from Continents and Regions
    And I click on ADD button
    Then "Polynesia" Countries are present in Selected Countries
    Then I select all countries from Selected Countries
    And I click on Remove Button
