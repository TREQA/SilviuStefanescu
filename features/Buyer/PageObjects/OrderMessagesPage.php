<?php
/**
 * Created by PhpStorm.
 * User: dgurau
 * Date: 6/14/2017
 * Time: 10:00 AM
 */

namespace BuyerPages;



use UtilsPage\Utils;
use UtilsPage\DataItems;

class OrderMessagesPage extends Utils
{
    const commonPath = "//*[@id=\"my-questions-table\"]/tbody/";

    /**
     * Order Messages menu
     */

    public function getDetailsLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"my-questions-table\"]/thead/tr/th[1]");
    }

    public function getOrdQuestionLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"my-questions-table\"]/thead/tr/th[2]");
    }

    public function getOrdAnswerLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"my-questions-table\"]/thead/tr/th[3]");
    }

    public function getOrdQuestionDateLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"my-questions-table\"]/tbody/tr[1]/td[1]/h5[2]");
    }

    public function getOrdAnswerDateLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"my-questions-table\"]/tbody/tr[1]/td[1]/h5[3]");
    }

    public function getOrdIdLabel(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"my-questions-table\"]/tbody/tr[1]/td[1]/h5[4]");
    }

    public function getOrderNo($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::commonPath."tr[".$row."]/td[1]/a");
    }

    public function getQuestion($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::commonPath."tr[".$row."]/td[2]");
    }

    public function getAnswer($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::commonPath."tr[".$row."]/td[3]");
    }

    public function getViewedQuestion(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id=\"question-form\"]/ol[2]/li/p");
    }

    public function getOrderQuestion($expectedOrderNo){
        $entries = $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","//*[@id=\"my-questions-table\"]/tbody/tr");
        echo "Entries found: ".count($entries)."\r\n";

        for($i=1;$i<=count($entries);$i++){
            $foundOrderNo = $this->getOrderNo($i)->getText();
            $formattedOrderNo = preg_replace('/[^0-9.]+/', '', $foundOrderNo);

            echo "expected ord No: ".$expectedOrderNo."\r\n";
            echo "found    ord No: ".$formattedOrderNo."\r\n";

            if($formattedOrderNo === $expectedOrderNo){
                echo"found it!";
                return $this->getQuestion($i);
            }else{
                throw new \RuntimeException(sprintf('Could not find order  '.$expectedOrderNo));
            }
        }
    }

    public function getOrderAnswer($expectedOrderNo){
        $entries = $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","//*[@id=\"my-questions-table\"]/tbody/tr");
        echo "Entries found: ".count($entries)."\r\n";

        for($i=1;$i<=count($entries);$i++){
            $foundOrderNo = $this->getOrderNo($i)->getText();
            $formattedOrderNo = preg_replace('/[^0-9.]+/', '', $foundOrderNo);

            echo "expected ord No: ".$expectedOrderNo."\r\n";
            echo "found    ord No: ".$formattedOrderNo."\r\n";

            if($formattedOrderNo === $expectedOrderNo){
                echo"found it!";
                return $this->getAnswer($i);
            }else{
                throw new \RuntimeException(sprintf('Could not find order  '.$expectedOrderNo));
            }
        }
    }

    public function getViewButton($row){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath",self::commonPath."tr[".$row."]/td[4]/span/a");
    }

    public function viewQuestion($expectedOrderNo){
        $entries = $this->waitUntilElementsPresent(DataItems::waitTime,"xpath","//*[@id=\"my-questions-table\"]/tbody/tr");
        echo "Entries found: ".count($entries)."\r\n";

        for($i=1;$i<=count($entries);$i++){
            $foundOrderNo = $this->getOrderNo($i)->getText();
            $formattedOrderNo = preg_replace('/[^0-9.]+/', '', $foundOrderNo);

            echo "expected ord No: ".$expectedOrderNo."\r\n";
            echo "found    ord No: ".$formattedOrderNo."\r\n";

            if($formattedOrderNo === $expectedOrderNo){
                echo"found it!";
                return $this->getViewButton($i);
            }else{
                throw new \RuntimeException(sprintf('Could not find order  '.$expectedOrderNo));
            }
        }
    }

    public function getSuccessMessage(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@data-ui-id='messages-message-success']");
    }

    /**
     * EditAnswer
     */
    public function getAnswerField(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@id='answer_text']");
    }

    public function getSubmitAnswerBtn(){
        return $this->waitUntilElementPresent(DataItems::waitTime,"xpath","//*[@title='Submit']");
    }

}