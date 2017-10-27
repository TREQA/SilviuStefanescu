<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/12/2017
 * Time: 12:37 PM
 */

namespace AdminPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class NewPoPage extends Utils
{

    public function getCreatePoBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@title=\"Create Purchase Orders\"]");
    }

}