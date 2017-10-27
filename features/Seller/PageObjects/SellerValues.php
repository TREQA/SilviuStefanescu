<?php


namespace SellerPages;


class SellerValues
{
    public static $randProdName = "";

    const disableAlert = "This action will disable product \"%s\".";
    const enableAlert = "This action will enable product \"%s\".";

    //dummy seller values
    const dummySellerFirstName = "DummyFirstName";
    const dummySellerLastName = "DummyLastName";

    public static $randSellerEmail = "";
    const dummySellerEmail = "dummy@seller.com";
    const dummyPhone = "0040123432344";

    const dummyPassword = "Password@123";
    const dummyRejectReason = "Automated Reject Reason";

    public static $randDummyCompanyName = "";
    const dummyCompanyName = "dummyCompanyName";
    const dummyCountry = "Romania";
    const dummyCity = "DummyCity";
    const dummyAddress = "DummyAddress nr.3";
    const dummyZipCode = "234124";
    const dummyComment = "DummyComments here for now";

    //Orders Values
    const buyCommTitle = "Buyer communication";
    const buyCommLabel = "Add question for buyer";
    const buyCommBtnTxt = "Send buyer question";
    const buyerQuestion = "This is the automated question that the seller asks";
    const buyerQuestionSentMsg = "Message was succesfully sent";

    //Product values
    const dummyDeviceProduct = "DummyDevice";
    const dummyAdvDeviceProduct = "AdvancedPricingAutoProduct";
    const dummyDeviceManNo = "10M";
    const dummyUnitPrice = "100.00"; //set to 10.00 for error from MKTPRD-647 to occur
    const dummyEditedUnitPrice = "200.00";
    const dummyWeight = "20.0000";
    const stockQty = "10";

    //adv pricing values
    const advPriceOne = "90.00"; //qty 10
    const advPriceTwo = "80.00"; //qty 30
    const advPriceThree = "70.00"; //qty 100

    const advPriceQtyOne = "10";
    const advPriceQtyTwo = "30";
    const advPriceQtyThree = "100";

    const advPriceQtyDef = "1";
    const advPriceDef = "95.00";

    const advPriceOffers = "Buy 10 for: €90.00 Buy 30 for: €80.00 Buy 100 for: €70.00";

    const offer1 = "Buy 10 for €90.00 each and save 6%";
    const offer2 = "Buy 30 for €80.00 each and save 16%";
    const offer3 = "Buy 100 for €70.00 each and save 27%";

    const radioFreqEU = "EU868 - Europe 863-870MHz";


    const batteryRechLi = "Rechargeable Lithium ion";

    //messages
    const disableMsg = "Product %s was disabled.";
    const enableMsg = "Product %s was sent for review.";
    const deleteMsg = "Product was deleted";
    const productSavedMsg = "Product has been saved";
    const sellerRegistrationMsg = "Thank you for application. As soon as your registration has been verified, you will receive an email confirmation";
    const sellerRejectionMsg = "This account is rejected.";

    //Shipping Rates
    const rateSaveSucMsg = "Rates has been saved";
    const allCountries = ['*** All ***'];

    const africaCountries = ["ALGERIA","ANGOLA","BENIN","BOTSWANA","BURKINA FASO","BURUNDI","CAMEROON","CAPE VERDE","CENTRAL AFRICAN REPUBLIC",
                             "CHAD","COMOROS","CONGO - BRAZZAVILLE","CONGO - KINSHASA","CôTE D’IVOIRE","DJIBOUTI","EGYPT","EQUATORIAL GUINEA","ERITREA","ETHIOPIA","GABON","GAMBIA",
                             "GHANA","GUINEA","GUINEA-BISSAU","KENYA","LESOTHO","LIBERIA","LIBYA","MADAGASCAR","MALAWI","MALI","MAURITANIA","MAURITIUS","MAYOTTE",
                             "MOROCCO","MOZAMBIQUE","NAMIBIA","NIGER","NIGERIA","RéUNION","RWANDA","SAINT HELENA","SãO TOMé AND PRíNCIPE","SENEGAL","SEYCHELLES",
                             "SIERRA LEONE","SOMALIA","SOUTH AFRICA","SUDAN","SWAZILAND","TANZANIA","TOGO","TUNISIA","UGANDA","WESTERN SAHARA","ZAMBIA","ZIMBABWE"];

    const easternAfricaCountries = ["BURUNDI","COMOROS","DJIBOUTI","ERITREA","ETHIOPIA","KENYA","MADAGASCAR","MALAWI","MAURITIUS","MAYOTTE",
                                    "MOZAMBIQUE","RWANDA","RÃ©UNION","SEYCHELLES","SOMALIA","TANZANIA","UGANDA","ZAMBIA","ZIMBABWE"];

    const middleAfricaCountries = ["ANGOLA","CAMEROON","CENTRAL AFRICAN REPUBLIC","CHAD","CONGO - BRAZZAVILLE",
                                   "CONGO - KINSHASA","EQUATORIAL GUINEA","GABON","SÃ£O TOMÃ© AND PRÃ­NCIPE"];

    const northernAfricaCountries = ["ALGERIA","EGYPT","LIBYA","MOROCCO","SUDAN","TUNISIA","WESTERN SAHARA"];

    const southernAfricaCountries = ["BOTSWANA","LESOTHO","NAMIBIA","SOUTH AFRICA","SWAZILAND"];

    const westernAfricaCountries = ["BENIN","BURKINA FASO","CAPE VERDE","CÃ´TE DÂ€™IVOIRE","GAMBIA","GHANA","GUINEA","GUINEA-BISSAU","LIBERIA",
                                    "MALI","MAURITANIA","NIGER","NIGERIA","SAINT HELENA","SENEGAL","SIERRA LEONE","TOGO"];

    const asiaCountries = ["AFGHANISTAN","ARMENIA","AZERBAIJAN","BAHRAIN","BANGLADESH","BHUTAN","BRUNEI","CAMBODIA","CHINA","CYPRUS","GEORGIA","HONG KONG SAR CHINA",
                           "INDIA","INDONESIA","IRAN","IRAQ","ISRAEL","JAPAN","JORDAN","KAZAKHSTAN","KUWAIT","KYRGYZSTAN","LAOS","LEBANON","MACAU SAR CHINA","MALAYSIA",
                           "MALDIVES","MONGOLIA","MYANMAR [BURMA]","NEPAL","NEUTRAL ZONE","NORTH KOREA","OMAN","PAKISTAN","PALESTINIAN TERRITORIES","PHILIPPINES","QATAR",
                           "SAUDI ARABIA","SINGAPORE","SOUTH KOREA","SRI LANKA","SYRIA","TAIWAN","TAJIKISTAN","THAILAND","TIMOR-LESTE","TURKEY","TURKMENISTAN",
                           "UNITED ARAB EMIRATES","UZBEKISTAN","VIETNAM","YEMEN",];

    const centralAsiaCountries = ["KAZAKHSTAN","KYRGYZSTAN","TAJIKISTAN","TURKMENISTAN","UZBEKISTAN"];

    const easternAsiaCountries = ["CHINA","HONG KONG SAR CHINA","JAPAN","MACAU SAR CHINA","MONGOLIA","NORTH KOREA","SOUTH KOREA","TAIWAN"];

    const southernAsiaCountries = ["AFGHANISTAN","BANGLADESH","BHUTAN","INDIA","IRAN","MALDIVES","NEPAL","PAKISTAN","SRI LANKA"];

    const southEasternAsiaCountries = ["BRUNEI","CAMBODIA","INDONESIA","LAOS","MALAYSIA","MYANMAR [BURMA]","PHILIPPINES","SINGAPORE","THAILAND","TIMOR-LESTE","VIETNAM"];

    const westernAsiaCountries = ["ARMENIA","AZERBAIJAN","BAHRAIN","CYPRUS","GEORGIA","IRAQ","ISRAEL","JORDAN","KUWAIT","LEBANON","NEUTRAL ZONE","OMAN",
                                  "PALESTINIAN TERRITORIES","QATAR","SAUDI ARABIA","SYRIA","TURKEY","UNITED ARAB EMIRATES","YEMEN"];

    const europeCountries = ["ÅLAND ISLANDS","ALBANIA","ANDORRA","AUSTRIA","BELARUS","BELGIUM","BOSNIA AND HERZEGOVINA","BULGARIA","CROATIA","CZECH REPUBLIC","DENMARK",
                             "ESTONIA","FAROE ISLANDS","FINLAND","FRANCE","GERMANY","GIBRALTAR","GREECE","GUERNSEY","HOLY SEE","HUNGARY","ICELAND","IRELAND","ISLE OF MAN",
                             "ITALY","JERSEY","LATVIA","LIECHTENSTEIN","LITHUANIA","LUXEMBOURG","MACEDONIA","MALTA","MOLDOVA","MONACO","MONTENEGRO","MONTENEGRO",
                             "NETHERLANDS","NORWAY","POLAND","PORTUGAL","ROMANIA","RUSSIA","SAN MARINO","SERBIA","SLOVAKIA","SLOVENIA","SPAIN","SVALBARD AND JAN MAYEN",
                             "SWEDEN","SWITZERLAND","UKRAINE","UNITED KINGDOM",];

    const easternEuropeCountries = ["BELARUS","BULGARIA","CZECH REPUBLIC","HUNGARY","MOLDOVA","POLAND","ROMANIA","RUSSIA","SLOVAKIA","UKRAINE"];

    const northernEuropeCountries = ["ÅLAND ISLANDS","DENMARK","ESTONIA","FAROE ISLANDS","FINLAND","GUERNSEY","ICELAND","IRELAND","ISLE OF MAN","JERSEY","LATVIA","LITHUANIA",
                                     "NORWAY","SVALBARD AND JAN MAYEN","SWEDEN","UNITED KINGDOM"];

    const southernEuropeCountries = ["ALBANIA","ANDORRA","BOSNIA AND HERZEGOVINA","CROATIA","GIBRALTAR","GREECE","HOLY SEE","ITALY","MACEDONIA","MALTA",
                                     "MONTENEGRO","PORTUGAL","SAN MARINO","SERBIA","MONTENEGRO","SLOVENIA","SPAIN",];

    const westernEuropeCountries = ["AUSTRIA","BELGIUM","FRANCE","GERMANY","LIECHTENSTEIN","LUXEMBOURG","MONACO","NETHERLANDS","SWITZERLAND"];

    const northAmericaCountries = ["ANGUILLA","ANTIGUA AND BARBUDA","ARUBA","BAHAMAS","BARBADOS","BELIZE","BERMUDA","BONAIRE SAINT EUSTATIUS AND SABA",
                                   "BRITISH VIRGIN ISLANDS","CANADA","CAYMAN ISLANDS","COSTA RICA","CUBA","CURAÃ§AO","DOMINICA","DOMINICAN REPUBLIC",
                                   "EL SALVADOR","GREENLAND","GRENADA","GUADELOUPE","GUATEMALA","HAITI","HONDURAS","JAMAICA","MARTINIQUE","MEXICO","MONTSERRAT",
                                   "NETHERLANDS ANTILLES","NICARAGUA","PANAMA","PUERTO RICO","SAINT BARTHÃ©LEMY","SAINT KITTS AND NEVIS","SAINT LUCIA","SAINT MARTIN",
                                   "SAINT PIERRE AND MIQUELON","SAINT VINCENT AND THE GRENADINES","TRINIDAD AND TOBAGO","TURKS AND CAICOS ISLANDS","U.S. VIRGIN ISLANDS",
                                   "UNITED STATES"];

    const caribbeanCountries = ["ANGUILLA","ANTIGUA AND BARBUDA","ARUBA","BAHAMAS","BARBADOS","BONAIRE SAINT EUSTATIUS AND SABA","BRITISH VIRGIN ISLANDS","CAYMAN ISLANDS",
                                "CUBA","CURAÃ§AO","DOMINICA","DOMINICAN REPUBLIC","GRENADA","GUADELOUPE","HAITI","JAMAICA","MARTINIQUE","MONTSERRAT","NETHERLANDS ANTILLES",
                                "PUERTO RICO","SAINT BARTHÃ©LEMY","SAINT KITTS AND NEVIS","SAINT LUCIA","SAINT MARTIN","SAINT VINCENT AND THE GRENADINES","TRINIDAD AND TOBAGO",
                                "TURKS AND CAICOS ISLANDS","U.S. VIRGIN ISLANDS"];

    const centralAmericaCountries = ["BELIZE","COSTA RICA","EL SALVADOR","GUATEMALA","HONDURAS","MEXICO","NICARAGUA","PANAMA"];

    const northernAmericaCountries = ["BERMUDA","CANADA","GREENLAND","SAINT PIERRE AND MIQUELON","UNITED STATES"];

    const oceaniaCountries = ["AMERICAN SAMOA","AUSTRALIA","COOK ISLANDS","FIJI","FRENCH POLYNESIA","GUAM","KIRIBATI","MARSHALL ISLANDS","MICRONESIA","NAURU","NEW CALEDONIA",
                              "NEW ZEALAND","NIUE","NORFOLK ISLAND","NORTHERN MARIANA ISLANDS","PALAU","PAPUA NEW GUINEA","PITCAIRN ISLANDS","SAMOA","SOLOMON ISLANDS",
                              "TOKELAU","TONGA","TUVALU","VANUATU","WALLIS AND FUTUNA"];

    const australiaandNewZeelandCountries = ["AUSTRALIA","NEW ZEALAND","NORFOLK ISLAND"];

    const melanesiaCountries = ["FIJI","NEW CALEDONIA","PAPUA NEW GUINEA","SOLOMON ISLANDS","VANUATU"];

    const micronesiaCountries = ["GUAM","KIRIBATI","MARSHALL ISLANDS","MICRONESIA","NAURU","NORTHERN MARIANA ISLANDS","PALAU"];

    const polynesiaCountries = ["AMERICAN SAMOA","COOK ISLANDS","FRENCH POLYNESIA","NIUE","PITCAIRN ISLANDS","SAMOA","TOKELAU","TONGA","TUVALU","WALLIS AND FUTUNA"];

    const southAmericaCountries = ["ARGENTINA","BOLIVIA","BRAZIL","CHILE","COLOMBIA","ECUADOR","FALKLAND ISLANDS",
                                   "FRENCH GUIANA","GUYANA","PARAGUAY","PERU","SURINAME","URUGUAY","VENEZUELA"];
}