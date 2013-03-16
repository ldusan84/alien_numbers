<?php
/**
 * Alien numbers
*
*
* @category   Alien numbers
* @package    Alien numbers
* @author     Dusan Lukic
*/

/**
*
* Converts number from one numeral system to decimal
*  
* @param string $number
* @param string $language
*
* @return int
*/
function convertToDecimal($number, $language)
{
    $numberChars = str_split($number);
    $languageChars = array_flip(str_split($language));
    $numberLength = strlen($number);
    $languageLength = strlen($language);
    $sum = 0;
    foreach($numberChars as $key => $char) {
        $sum += $languageChars[$char] * pow($languageLength, $numberLength - $key - 1);
    }
    return $sum;
}

/**
*
* Converts number from one decimal numeral system to another
*  
* @param string $number
* @param string $language
*
* @return string
*/
function convertFromDecimal($number, $language)
{
    $languageLength = strlen($language);
    $final = "";
    while($number != 0){
        $index = $number % $languageLength;
        $final = $language[$index] . $final;
        $number = floor($number / $languageLength);
    }
    return $final;
}

/**
 *
 * Solves Alien number problem with given path
 *
 * @param string $filePath
 *
 * @return string
 */
function solve($filePath)
{
    $contents = file_get_contents($filePath);
    $lines = explode("\n", $contents);
    unset($lines[0]);
    $output = array();
    foreach($lines as $key => $line){
        list($number, $sourceLanguage, $targetLanguage) = explode(" ", $line);
        $decimalNumber = convertToDecimal($number, $sourceLanguage);
        $targetNumber = convertFromDecimal($decimalNumber, $targetLanguage);
        $output[] = "Case #" . $key . ": " . $targetNumber;
    }
    
    return implode("\n", $output);
}
