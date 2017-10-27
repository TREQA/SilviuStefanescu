<?php


namespace BuyerPages;

class BuyerValues
{
    const categ1 ="iot-devices/";
    const sub1Categ1 ="field-tests/";

    const noResMsg = "Your search returned no results.";

    //valid credit card details
    const validVisaCardNo = "4484120000000029";
    const validCardHolderName = "AutoCardHolder";
    const validCardExpDateMonth = "10";
    const validCardExpDateYear = "2020";
    const validCardCvv = "333";

    //
    public static $orderID = "";

    const buyerAnswer = "This is my automated response to your question";

    const paymentPendingMsg = "Your order number is: %s.";
    const orderPlacedMsg = "We will email your order confirmation with tracking details once your payment is confirmed.";
    const answerSubmittedMsg = "The communication has been saved.";

    //Buyer/Anon Menu Pages

    const devices = "Devices";
    const devKitsFieldTests = "Dev Kits & Field Tests";
    const thingParkApproved = "ThingPark Approved";
    const solutions = "Solutions";
    const ourSellers = "Our Sellers";
    const thingParkConnected = "Thing Park Connected";
    const orange = "Orange";
    const menuOptions = ['Devices','Gateways','ThingPark Connected','Solutions','Sellers'];
    const expectedTitle = ['Devices','Gateways','ThingPark Connected','Solutions','Sellers'];
    const expectedUrls = ['https://market.preprod.thingpark.com/iot-devices.html',
                          'https://market.preprod.thingpark.com/gateways.html',
                          'https://market.preprod.thingpark.com/thingpark-connected.html',
                          'https://market.preprod.thingpark.com/solutions.html',
                          'https://market.preprod.thingpark.com/sellers.html'];

    //Buyer/Anon Products Filtering

    const expectedProducts = ['AUTOMATEDLISTINGVENDORPRODUCT1'];
    const sortByOptions = ['                Position            ',
                           '                Name            ',
                           '                Unit Price            ',
                           '                ThingPark Connected            '];
    const wishListTitle = "My Wish List";
    const emptyWishList = "You have no items in your wish list.";

    //Advanced Search values

    const advSearchFields = ['Name','SKU','Description','Short Description','Unit Price Range','Radio Frequency Band','Certification'];

    const advSPopUpName = 'Advanced Search';
    const advSRandomName = 'AdvancedDummyName';
    const advSRandomSku = 'AdvancedDummySku';
    const advSRandomDescription = 'AdvancedDummyDescription';
    const advSRandomShortDescription = 'AdvancedDummy ShortDescription';
    const advSRandomFirstPrice = '1324';
    const advSRandomSecondPrice = '56783';
    const advSNoProdMessage = 'We can\'t find any items matching these search criteria. Modify your search.';

    const advSCorrectName = 'test';
    const advSCorrectSku = '';
    const advSCorrectDescription = '';
    const advSCorrectShortDescription = '';
    const advSCorrectFirstPrice = '';
    const advSCorrectSecondPrice = '';
    const advSFoundProdMessage = 'Don\'t see what you\'re looking for? Modify your search.';
}