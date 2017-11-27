<?php
/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 08-May-17
 * Time: 12:05 PM
 */

namespace UtilsPage;

class DataItems
{

    //paths
    const sellerPath ="udropship/vendor/";
    const sellerRegisterPath ="umicrosite/vendor/register/";
    const sellerLoginPath ="https://market.preprod.thingpark.com/udropship";
    const mailHog = "http://mh.int.actility.com/#";
    const path = "https://market.preprod.thingpark.com/";

    // previous link:
    // const becomeSellerLink = "https://market.preprod.thingpark.com/seller";
    // replaced with:
    const becomeSellerLink = "https://market.preprod.thingpark.com/umicrosite/vendor/register/";
    const searchFieldText = "Search entire store here...";

    //
    const itemsBought = "1";
    const itemsBoughtNo = "1";
    const editItem = "edit";
    const waitTime = 10000000; //10 sec
    public static $randomInt = '';
    public static $productPrice = ''; //value is modified when clicking on add to cart from a product details page
    public static $productName = ''; //value is modified when clicking on add to cart from a product details page
    public static $vendRandName = '';
    public static $vendRandEmail = '';


    //Values
    const editButtonTitle = "Edit item";
    const deleteButtonTitle = "Remove item";
    const viewEditCart = "View and edit cart";
    const buyerSignIn = "Sign In";
    const buyerCreateAcc = "Create an Account";
    const edited = "edited";

    const noPriceProd = "NoPriceAutoProduct";
    const pdfTableTitle = "Technical docs";

    public static $noPriceProdRand = "You did not sign in correctly or your account is temporarily disabled.";

    //My Cart details
    const subtotalTitle = "Cart Subtotal";
    const checkoutButton = "Go to Checkout";
    const cartLoadMask = "(Drop Shipping (Split) - Total)";

    //Credentials
    const adminMail = "automated";
    const adminPassword = "Password@123";

    const sellerMail = "asuspad.tremend@gmail.com";
    const sellerPassword = "Password@123";

    const buyerMail = "testanimalesdoitreidoi@tremend.ro";
    const buyerPassword = "Tremend10ani";

    //dummy credentials
    const dummyPassword = "Password123";
    const dummyOldPassword = "Password122";
    const dummyEmail = "autotest@mail.com";

    const dummyBuyerFirstName = "auto";
    const dummyBuyerLastName = "test";

    const dummyVendorName = "dummyVendor";
    const dummyVendorEmail = "dummy@vendor.com";
    const dummyVendorPass = "dummyPass123";
    const vendorShipStreet = "dummyVendorShipStreet";
    const vendorShipCity = "dummyVendorShipCity";
    const vendorBillStreet = "dummyVendorBillStreet";
    const vendorBillCity = "dummyVendorBillCity";
    const dummyVendorCarr = "Flat Rate";
    const dummyVendorCarrEdit = "DHL";
    const dummyVendorPhone = "0333222111";
    const dummyVendorFax = "fax 0333222111";
    const dummyVendorZip = "010101";
    const dummyVendorBillZip = "010101";
    const vendorTaxClass = "france";

    const recoverPassEmailInv = "email@format.com";
    const recoverPassCaptchaInv = "wrongCaptcha";

    //Buyer
    const validBuyerName = "ipad3.tremend@gmail.com";
    const validBuyerPassword = "Parola12457";

    //page titles
    const createAccTitle = "Create New Customer Account";
    const loginPageTitle = "Customer Login";
    const createAccPopUpContent = "Only registered customers can access this content.";
    const checkoutNew = "Checkout out as a new customer";
    const checkoutExisting = "Checkout out using your account";
    const sellerLoginPageTitle = "Seller Log in";
    const privacyPolicyTitle = "Privacy Policy";

    //messages
    const succAccCreateMsg = "If you are a registered VAT customer, please click here to enter your shipping address for proper VAT calculation.";
    Const itemAddedMessage = "You added .* to your shopping cart";

    const invalidCredentialsMsg = "Invalid login or password.";
    const sellerInvalidCredMsg = "Invalid username or password.";
    const recoverBuyerPasswordMsg = "Please enter your email address below to receive a password reset link.";

    const productSaveMsg = "You saved the product.";
    const vendorSaveMsg= "Vendor was successfully saved";

    const tcpMessage = "By continuing your visit to this site you accept our web-site term of use, our data privacy and our buyer agreement. Ok Read More";

    //Buyer Menu Pages
    const devices = "Devices";
    const devKitsFieldTests = "Dev Kits & Field Tests";


}