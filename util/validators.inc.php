<?php

/*
 * Functions to check if customer inputs are valid
 */

/**
 * checks if parameter is integer and if length = 5
 * 
 * @param $zip : zip code
 * @return : bool
 */
function isZip($zip) {
    return strlen($zip) == 5 && isInt($zip);
}

/**
 * checks if parameter is an integer (regex)
 * 
 * @param $value
 * @return : bool
 */
function isInt($value) {
    return preg_match("/[^0-9]/", $value) == 0;
}

/**
 * checks if parameter is an email (regex)
 * 
 * @param $email
 * @return : bool
 */
function isEmail($email) {
    return preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $email);
}


