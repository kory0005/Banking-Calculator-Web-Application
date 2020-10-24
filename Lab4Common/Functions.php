<?php
function ValidateTerms ($checkBox) {
    if (empty($checkBox)) {
        return "You must agree with terms and conditions";
    }
    return '';
}


function ValidateName($name){
    $nameError = "";
    if ( $name == '' ) {
        $nameError = "Name is required";
    }
    return $nameError;
}


function ValidatePostalCode($postalCode){
    $postalCodeError = "";
    if( !trim($postalCode) ) {
        $postalCodeError = "Postal code is required";
    }
    else if(!preg_match("/[a-z][0-9][a-z]\s*[0-9][a-z][0-9]/i", $postalCode)){
        $postalCodeError = "Incorrect postal code";
    }
    return $postalCodeError;
}


function ValidatePhone($number){
    $phoneNumberError = "";
    if( !trim($number) ) {
        $phoneNumberError = "Phone number is required";
    } else if(!preg_match("/^[2-9][0-9]{2}-[2-9][0-9]{2}-[0-9]{4}$/i", $number)) {
        $phoneNumberError = "Incorrect phone number";
    }
    return $phoneNumberError;
}


function ValidateEmail($email){
    $emailError = "";
    if(!trim($email)) {
        $emailError = "Email is required";
    }
    else if (!preg_match("/^([a-z0-9\+.]+)*@([a-z\-]+\.)+[a-z]{2,4}$/ix", $email)){
        $emailError = "Incorrect email address";
    }
    return $emailError;
}


function ValidatePrincipal($amount) {
    $principalAmountError = "";
    if( !trim($amount) ) {
        $principalAmountError = "Principal amount is required";
    } else {
        if ( !is_numeric($amount) ) {
            $principalAmountError = "Principal amount must be numeric and greater than 0";
        } else if ( $amount <= 0 ) {
            $principalAmountError = "Principal amount must be greater than 0";
        }
    }
    return $principalAmountError;
}


function ValidateRate($amount) {
    $interestRateError = "";
    if ( !trim($amount) ) {
        $interestRateError = "Interest rate is required";
    } 
    else {
        if ( !is_numeric($amount) ){
            $interestRateError = "Interest rate must be numeric and not negative";
        } 
        else if ( $amount < 0 ) {
            $interestRateError = "Principal amount must not be negative";
        }
    }
    return $interestRateError;
}


function ValidateYears($years) {
    $yearsToDepositError = "";
    if ( $years == "") {
        $yearsToDepositError = "Years to deposit is required";
    }
    else if( $years < "1" || $years > "20" ) {
        $yearsToDepositError = "Years to deposit must be numeric and between 1 and 20";
    }
    return $yearsToDepositError;
}
