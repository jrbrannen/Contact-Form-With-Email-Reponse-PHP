<?php
    /**
     * Sends an email response using key:value pairs from the contact form
     */
    function sendReponse($inFirstName, $inLastName, $inDateOfBirth, $inEmailAddress, $inMessage){
        $to = $inEmailAddress;        // email address
        $subject = "Contact Form Confirmation message";     // subject
        $message =  "<br>Hello,<br> 
                    This is a confirmation message that my contact form processed. 
                    All the contact form information is as follows:" . 
                    "<br>First Name: " . $inFirstName .
                    "<br>Last Name: " . $inLastName .
                    "<br>Date Of Birth: " . $inDateOfBirth .
                    "<br>Email Address: " . $to . 
                    "<br>Message: " . $inMessage .
                    "<br>Thank you.  
                    <br><br>Regards, 
                    <br> Jeremy Brannen";
        
        $headers = "From: jeremybrannen@jeremybrannen.info" . "\r\n";   // email address from host server
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";    // formats for http

        mail($to,$subject,$message,$headers);   // send out email
    }
    
?>