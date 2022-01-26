<?php
// file validates input text fields for contact form

/**
 * Sanitizes string input, checks for empty value or string value
 * over 25 chars and sets appropiate error message.  Returns false if
 * string is not valid. Returns true if string is valid. 
 */
function validateFirstName($inName){
    global $errFirstName, $generalErrorMsg;
    define("MAX_FNAME_LENGTH", 15);
    $errFirstName = "*";
    $inName = filter_var($inName, FILTER_SANITIZE_STRING);
    $inName = htmlspecialchars($inName, ENT_NOQUOTES);
    
    if($inName == ""){
        $generalErrorMsg .= "* Required Field <br>";
        return false;
    }
    if(strlen($inName) > MAX_FNAME_LENGTH){
        $generalErrorMsg .= "* First name cannot be more than 15 characters <br>";
        return false;
    }
    $errFirstName = "";
    return true;
}

/**
 * Sanitizes string input, checks for empty value or string value
 * over 15 chars and sets appropiate error message.  Returns false if
 * string is not valid. Returns true if string is valid. 
 */
function validateLastName($inName){
    global $errLastName, $generalErrorMsg;
    define("MAX_LNAME_LENGTH", 20);
    $errLastName = "*";
    $inName = filter_var($inName, FILTER_SANITIZE_STRING);
    $inName = htmlspecialchars($inName, ENT_NOQUOTES);
    
    if($inName == ""){
        $generalErrorMsg .= "* Required Field <br>";
        return false;
    }
    if(strlen($inName) > MAX_LNAME_LENGTH){
        $generalErrorMsg .= "* Last name cannot be more than 20 characters. <br>";
        return false;
    }
    $errLastName = "";
    return true;
}

/**
 * Checks date input variable for mm/dd/yyyy pattern and sets appropiate
 * error message.  Returns true if format is valid.  Returns false if 
 * format is not valid.
 */
function validateDateOfBirth($inDate){
    global $errDateOfBirth, $generalErrorMsg;
    define("MIN_MONTH", 1);
    define("MAX_MONTH", 12);
    define("MIN_DAY", 1);
    define("MAX_DAY", 31);
    define("MIN_YEAR", 1910);
    define("MAX_YEAR", 2021);
    $errDateOfBirth = "*";
    $dateRegex = "/^\d{2}\/\d{2}\/\d{4}$/";

    if($inDate == ""){
        $generalErrorMsg .= "* Required Field <br>";
        return false;
    }elseif(preg_match($dateRegex, $inDate) === 0){
        $generalErrorMsg .= "* Date must be in mm/dd/yyyy format. <br>";
        return false;
    }
    if(substr($inDate, 0, 2) < MIN_MONTH || substr($inDate, 0, 2) > MAX_MONTH){
        $generalErrorMsg .= "* Month must be between 1-12.";
        return false;
    }
    if(substr($inDate, 3, 2) < MIN_DAY || substr($inDate, 3, 2) > MAX_DAY){
        $generalErrorMsg .= "* Day must be between 1-31.";
    }
    if(substr($inDate, 6, 4) < MIN_YEAR || substr($inDate, 6, 4) > MAX_YEAR){
        $generalErrorMsg .= "* Year must be between 1910-2021.";
    }
    $errDateOfBirth = "";
    return true;
}

/**
 * Validates email and sets correct error message. If email is 
 * valid returns true.  If not valid returns false.
 */
function validateEmail($inEmail){
    global $errEmailAddress, $generalErrorMsg;
    $errEmailAddress = "*";
    $inEmail = filter_var($inEmail, FILTER_SANITIZE_EMAIL);
    
    if($inEmail == ""){
        $generalErrorMsg .= "* Required Field <br>";
        return false;
    }
    if(filter_var($inEmail, FILTER_VALIDATE_EMAIL) === false){
        $generalErrorMsg .= "* Email is invalid.  Please enter a valid email. <br>";
        return false;
    }
    $errEmailAddress = "";
    return true;
}

/**
 * Sanitizes string input, checks for empty value or string value
 * over 150 chars and sets appropiate error message.  Returns false if
 * string is not valid. Returns true if string is valid. 
 */
function validateMessage($inMessage){
    global $errMessage, $generalErrorMsg;
    define("MAX_MESSAGE_LENGTH", 150);
    $errMessage = "*";
    $inMessage = filter_var($inMessage, FILTER_SANITIZE_STRING);
    $inMessage = htmlspecialchars($inMessage, ENT_NOQUOTES);

    if($inMessage == ""){
        $generalErrorMsg .= "* Required Field <br>";
        return false;
    }
    if(strlen($inMessage) > MAX_MESSAGE_LENGTH){
        $generalErrorMsg .= "* Message length must be 150 characters or less. <br>";
    }
    $errMessage = "";
    return true;
}
?>