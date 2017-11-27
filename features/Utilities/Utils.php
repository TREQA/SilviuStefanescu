<?php

namespace UtilsPage;


use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

/**
 * Created by PhpStorm.
 * User: Daniel Gurau
 * Date: 05-May-17
 * Time: 1:46 PM
 */

class Utils extends Page
{

    public function findElement($selector,$path) {
        $element = $this->getSession()->getPage()->find($selector,$path);
        if (!$element) {
            throw new \RuntimeException(sprintf('Could not find element %s', $path));
        }

        return $element;
    }

    //if no file exists the tests will fail, a contor.txt file must be created in the specified path
    // with a number that was not used before for account creation
    public function incrementContor(){
        $filePath = 'C:/Selenium/contor.txt';
        $contorTxt = file_get_contents($filePath);
        file_put_contents($filePath,$contorTxt+1);
        return $contorTxt+1;
    }

    public function getContor(){
       return file_get_contents('C:/Selenium/contor.txt');
    }

    /**
     * WAITS
     */

    //Waits until element is present and visible - new method

    public function waitUntilElementPresentAndVisible($timeOut, $selector, $path){
        $timeElapsed = 0;
        $tryTime = 150000;
        while ($timeElapsed <= $timeOut) {
            usleep($tryTime);
            $element = $this->getSession()->getPage()->find($selector, $path);
            if ($element != null && $element->isVisible()) {
                return $element;
            }
            $timeElapsed += $tryTime;
        }
        throw new \RuntimeException(sprintf('Could not find element %s', $path));
    }

    // Waits until element is present - Old

    public function waitUntilElementPresent($timeOut,$selector,$path){
        $timeElapsed = 0;
        $tryTime = 100000;
        while($timeElapsed<=$timeOut){
            usleep($tryTime);
            $element = $this->getSession()->getPage()->find($selector,$path);
            if($element!=null){
                return $element;
            }
            $timeElapsed+=$tryTime;
        }
        throw new \RuntimeException(sprintf('Could not find element %s', $path));
    }

    // Waits until elementS are present - old

    public function waitUntilElementsPresent($timeOut,$selector,$path){
        $timeElapsed = 0;
        $tryTime = 100000;
        while($timeElapsed<=$timeOut){
            usleep($tryTime);
            $elements = $this->getSession()->getPage()->findAll($selector,$path);
            if($elements!=null){
                return $elements;
            }
            $timeElapsed+=$tryTime;
        }
        throw new \RuntimeException(sprintf('Could not find element %s', $path));
    }

    //Waits until element is invisible - old

    public function waitUntilElementInvisible($timeOut,$selector,$path){
        $timeElapsed = 0;
        $tryTime = 100000;
        while($timeElapsed<=$timeOut){
            usleep($tryTime);

            $element = $this->getSession()->getPage()->find($selector,$path);
            if(!$element){
                return true;
            }

            $elementIsVisible = $element->isVisible();
            if(!$elementIsVisible){
                return true;
            }
            $timeElapsed+=$tryTime;
        }
        throw new \RuntimeException(sprintf("Waited 10 second for element to disappear", $path));
    }

    //Waits until element is visible - Old

    public function waitUntilElementVisible($timeOut,$selector,$path){
        self::waitUntilElementsPresent($timeOut,$selector,$path);
        $timeElapsed = 0;
        $tryTime = 100000;
        while($timeElapsed<=$timeOut){
            usleep($tryTime);
            $element = $this->getSession()->getPage()->find($selector,$path)->isVisible();
            if($element == true){
                return true;
            }
            $timeElapsed+=$tryTime;
        }
        throw new \RuntimeException(sprintf("Waited 10 second for element to appear", $path));
    }

    public function waitUntilSizeZero($timeOut,$selector,$path){
        $timeElapsed = 0;
        $tryTime = 500000;
        while($timeElapsed<=$timeOut){
            usleep($tryTime);
            $style = $this->waitUntilElementPresent(DataItems::waitTime,$selector,$path)->getAttribute('style');
            if($style!=true){
                return true;
            }
            $timeElapsed+=$tryTime;
        }
        throw new \RuntimeException(sprintf("Waited 10 second for element to disappear", $path));
    }

    //getCssValue
    public function assertStyleValue ($path,$value){
        $style = $this->getSession()->getPage()->find('xpath',$path)->getAttribute('style');
        if($style==$value){
            return true;
        }else{
            return false;
        }
    }

    public function assertElementHasCssValue($selector, $property, $value)
    {
        $page = $this->getSession()->getPage();
        $element = $page->find('xpath', $selector);

        if (empty($element)) {
            $message = sprintf('Could not find element using the selector "%s"', $selector);
            throw new \Exception($message);
        }
        $style = $this->elementHasCSSValue($element, $property, $value);
        echo "style ".$style."\r\n";
        if (empty($style)) {
            $message = sprintf('The property "%s" for the selector "%s" is not "%s"', $property, $selector, $value);
            throw new \Exception($message);
        }
    }

    protected function elementHasCSSValue($element, $property, $value)
    {
        $exists = FALSE;
        $style = $element->getAttribute('style');
        echo "style".$style."\r\n";
        if (true) {
            if (preg_match("/(^{$property}:|; {$property}:) ([a-z0-9]+);/i", $style, $matches)) {
                $found = array_pop($matches);
                echo "found ".$found."\r\n";
                echo "value ".$value;
                if ($found == $value) {
                    $exists = $element;
                }
            }
        }
        return $exists;
    }

    /**
     * Navigate
     */
    public function goToMyAccMenu($menuName){
        $menus = $this->getSession()->getPage()->findAll("xpath","//*[@id=\"block-collapsible-nav\"]/ul/li");
        foreach ($menus as $menu){
            $title = $menu->getText();
            if($title == $menuName){
                $menu->click();
                break;
            }
        }
    }

    //Admin Select Product dropdown
    public function addProductType($menuName){
        $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='add_new_product']/button[2]")->click();
        $menus = $this->getSession()->getPage()->findAll("xpath","//*[@id=\"add_new_product\"]/ul/li");
        foreach ($menus as $menu){
            $title = $menu->getText();
            if($title == $menuName){
                $menu->click();
                break;
            }
        }
    }

    public function getSelectedOption($selector,$selectLocator){
        $options = $this->waitUntilElementsPresent(DataItems::waitTime,$selector,$selectLocator."/option");
        foreach ($options as $option) {
            $selected = $option->getAttribute("selected");
            if($selected == "selected"){
                return $option;
            }
        }
        throw new \RuntimeException(sprintf("Something went wrong!"));
    }

    public function setSearchField($selectorType,$dropdownPath,$searchFieldPath,$resultPath,$value){
        //getDropdown
        $this->waitUntilElementPresentAndVisible(DataItems::waitTime,$selectorType,$dropdownPath)->click();
        //getSearchField
        $this->waitUntilElementPresentAndVisible(DataItems::waitTime,$selectorType,$searchFieldPath)->setValue($value);
        //getResultField
        Sleep(2);
        $this->waitUntilElementPresentAndVisible(DataItems::waitTime,$selectorType,$resultPath)->click();
    }

    public function scrollIntoView($path){
        $this->getSession()->getDriver()->executeScript("function(){
                var elem = document.evaluate('$path', document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
                elem.scrollIntoView();
            }");
    }

    public function scrollToTop(){
        $this->getSession()->getDriver()->executeScript(
            'jQuery(\'html,body\').animate({scrollTop: 0}, \'0\');'
        ); //this requires jquery library
    }

    public function pressKey($key)
    {
        $script = "jQuery.event.trigger({ type : 'keypress', which : '" . $key . "' });";
        $this->getSession()->evaluateScript($script);
    }

    public function acceptAlert(){
        $this->getSession()->getDriver()->executeScript("
               window.confirm = function(){return true;}
               ");
    }

    public function checkboxScript($identifier,$state){
        $this->getSession()->getDriver()->executeScript("
               jQuery('$identifier').attr('checked','$state')
               ");
    }

    public function randomInt(){
        return rand(0,10000000);
    }

    public function waitForJQuery(){
        $this->getSession()->wait(5000, '(typeof(jQuery)=="undefined" || (0 === jQuery.active && 0 === jQuery(\':animated\').length))');
    }
    public function waitForAjaxResponse(){
        $this->getSession()->wait(5000,'(0 === jQuery.active)');
    }
}