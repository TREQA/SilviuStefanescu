Feature: Communicating between buyer, seller and admin
  I must be able to communicate
  As a user of ThinkPark app
  With other relevant entities (seller, buyer, admin)

  @javascript @insulated
  Scenario: Verify the process of communication between buyer and seller without admin approval
    Given I am logged in as "buyer"
    And I have an empty Cart
    When I add to cart the "TestAutoDeviceProd" product from listing page
    Then I click on My Cart
    And I click on Go to Checkout button
    Then I click on Proceed to Checkout
    And I click on Next
    Then I chose to pay via Bank Transfer Payment
    And I agree on the terms and conditions for the seller and ThinkPark
    Then I click on "Place Order"
    And Order has been placed successfully
    Given I am logged in as "admin"
    When I go to Orders page
    And I search for the order previously created by the buyer
    Then I view the order
    And I click on Create Po
    Then I create the Po
    And I go to Vendor page
    Then I search for the vendor of the bought product and edit
    And I set the Require admin approval for vendor-customer communication option set to "No" and save
    Given I am logged in as "seller"
    When I go to Seller's Orders page
    And I search for the order with PO created
    Then I open order information
    And buyer communication section is present
    Then I submit a question to the buyer regarding the order
    And Confirmation message regarding question being sent is displayed
    Given I am a logged in "buyer"
    When I go to My Account > Orders Messages
    Then seller's question is present
    And I click on view and submit my answer
    Then a message regarding answer being submitted is shown
    Given I am a logged in "admin"
    When I go to Sales > Order Communications menu
    And I search for the question submitted by the seller
    Then I edit the question
    And Question and answer are present
    Then I approve the buyer's answer
    And a message is shown regarding answer approved

  @javascript @insulated
  Scenario: Verify the process of communication between buyer and seller with admin approval
    Given I am logged in as "buyer"
    And I have an empty Cart
    When I add to cart the "TestAutoDeviceProd" product from listing page
    Then I click on My Cart
    And I click on Go to Checkout button
    Then I click on Proceed to Checkout
    And I click on Next
    Then I chose to pay via Bank Transfer Payment
    And I agree on the terms and conditions for the seller and ThinkPark
    Then I click on "Place Order"
    And Order has been placed successfully
    Given I am logged in as "admin"
    When I go to Orders page
    And I search for the order previously created by the buyer
    Then I view the order
    And I click on Create Po
    Then I create the Po
    And I go to Vendor page
    Then I search for the vendor of the bought product and edit
    And I set the Require admin approval for vendor-customer communication option set to "Yes" and save
    Given I am logged in as "seller"
    When I go to Seller's Orders page
    And I search for the order with PO created
    Then I open order information
    And buyer communication section is present
    Then I submit a question to the buyer regarding the order
    And Confirmation message regarding question being sent is displayed
    Given I am a logged in "admin"
    When I go to Sales > Order Communications menu
    And I search for the question submitted by the seller
    Then Seller's question has status "Pending" while Buyer answer has status "Pending"
    And I edit the question
    Then I change seller's question status to "Approved"
    And a message is shown regarding answer approved
    Given I am a logged in "buyer"
    When I go to My Account > Orders Messages
    Then seller's question is present
    And I click on view and submit my answer
    And the page contains all the necessary information
    Then answer is present under answer column
    And a message regarding answer being submitted is shown
    Given I am a logged in "admin"
    When I go to Sales > Order Communications menu
    And I search for the question submitted by the seller
    Then Seller's question has status "Approved" while Buyer answer has status "Pending"
    And I edit the question
    Then Buyer answer has status "Pending" in edit mode
    And Question and answer are present
    Then I change buyer's answer status to "Approved"
    And a message is shown regarding answer approved
    Then Seller's question has status "Approved" while Buyer answer has status "Approved"

  @javascript @insulated
  Scenario: Verify that a seller is able to access system view
    Given I am logged in as "seller"
    And I go to System View Menu
    Then I switch to pop up tab
    And I am logged in as "sellerINadmin"
    Then I go to Products Catalog page
    And I click on Add Product Options
    Then I should see all options from Add Product Options from system view

  @javascript @insulated
  Scenario: Verify that seller can modify products from system view
    Given I am logged in as "seller"
    And I go to System View Menu
    Then I switch to pop up tab
    And I am logged in as "sellerINadmin"
    Then I go to Products Catalog page
    And I search for "Device" product type
    Then I click the first product in the list
    When I click on Content Section
    Then ThingPark Connected option is not available
    Then I go to Products Catalog page
    And I search for "Partner" product type
    Then I click the first product in the list
    When I click on Content Section
    Then ThingPark Connected option is not available
    Then I go to Products Catalog page
    And I search for "Gateway" product type
    Then I click the first product in the list
    When I click on Content Section
    Then ThingPark Connected option is not available
    Then I go to Products Catalog page
    And I search for "Service" product type
    Then I click the first product in the list
    When I click on Content Section
    Then ThingPark Connected option is not available
    Then I go to Products Catalog page
    And I search for "Product - No Price" product type
    Then I click the first product in the list
    When I click on Content Section
    Then ThingPark Connected option is not available
    Then I go to Products Catalog page
    And I search for "Integrated Solution" product type
    Then I click the first product in the list
    When I click on Content Section
    Then ThingPark Connected option is not available

  @javascript @insulated
  Scenario: Verify that if a seller adds a product from system view, buyers will be able to see it
    Given I am logged in as "seller"
    When I go to System View Menu
    Then I switch to pop up tab
    And I am logged in as "sellerINadmin"
    Then I go to Products Catalog page
    And I click on add product
    Then I set all the mandatory fields for the product
    And I click on Save button
    Then Product is saved
    Given I am an anonymus user
    And I search for the previously added product from system view
    Then Product from system view is found

  @javascript @insulated
  Scenario: Verify that a Seller can upload an invoice for a PO - to be modified when hipay/bank transfer are fixed
    Given I am logged in as "seller"
    And I click on the first order
    And I attach Invoice to order
    Then Attached PDF is the same as the Order Number

  @javascript @insulated
  Scenario: Verify that a buyer can see the invoice in his account - to be modified when hipay/bank transfer are fixed
    Given I am logged in as "buyer"
    And I click on first View Invoice
    Then The invoice is opened
    
