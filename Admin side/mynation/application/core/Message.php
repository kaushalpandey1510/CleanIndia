<?php

class Message {

    var $mobile = "9909413561";
    var $password = "growkushgrow";
    var $key = "sun.aL5xT3FYSJuA9se2URK6";
    var $url = "https://smsapi.engineeringtgr.com/send";

    public function sendMsgForComplaintConfirmation($user, $complaint_id) {
        //  send message to billing detail
        $message = "Dear $user->name, we have received your complaint. You can track the status of your complaint using complaint id $complaint_id.";
        json_decode(file_get_contents("$this->url/?Mobile=$this->mobile&Password=$this->password&Message=" . urlencode($message) . "&To=" . urlencode($user->phone_number) . "&Key=$this->key"), true);
    }

    public function sendMsgForComplaintResolution($user, $complaint_id) {
        $message = "Dear $user->name, Your complaint for the complaint id $complaint_id has been resolved. Thanks for your help in making our nation clean.";
        json_decode(file_get_contents("$this->url/?Mobile=$this->mobile&Password=$this->password&Message=" . urlencode($message) . "&To=" . urlencode($user->phone_number) . "&Key=$this->key"), true);
    }

}
