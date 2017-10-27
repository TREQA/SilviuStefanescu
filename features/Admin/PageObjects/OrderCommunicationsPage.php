<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/14/2017
 * Time: 11:52 AM
 */

namespace AdminPages;


use UtilsPage\Utils;
use UtilsPage\DataItems;

class OrderCommunicationsPage extends Utils
{
    const commonPath = "//*[@id=\"messageGrid_table\"]/tbody/";

    public function getQuestionField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"messageGrid_filter_communication_text\"]");
    }

    public function getSearchBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"messageGrid\"]/div[1]/div[2]/div[1]/button[1]");
    }

    public function getEditBtn($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::commonPath."tr[".$row ."]/td[11]/a");
    }

    public function getCommDateFilter(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-sort='communication_date']");
    }

    public function getSuccessMsg(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id='messages-message-success']");
    }

    public function getCommStatus($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::commonPath."tr[".$row ."]/td[3]");
    }

    public function getAnswerStatus($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::commonPath."tr[".$row ."]/td[8]");
    }


    /**
     * Edit order communication
     */

    public function getSellerQuestion(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='communication_text']");
    }

    public function getBuyerAnswer(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='answer_text']");
    }

    public function getCommStatusDropdown(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='communication_status']");
    }

    public function getAnswerStatusDropdown(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='answer_status']");
    }

    public function getSelectedAnswerStatus(){
        return $this->getSelectedOption("xpath","//*[@id='answer_status']");
    }

    public function getSaveBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='save_button']");
    }
}