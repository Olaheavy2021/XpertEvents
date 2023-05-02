<?php

// * validate data presence
// * uses trim() so empty spaces don't count
// * uses === to avoid false positives
// * better than empty() which considers "0" to be empty
/**
 * @param $value
 * @return bool
 */
function isBlank($value): bool
{
    return !isset($value) || trim($value) === '';
}

// * validate data presence
// * reverse of is_blank()
/**
 * @param $value
 * @return bool
 */
function hasPresence($value): bool
{
    return !isBlank($value);
}

// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
/**
 * @param $value
 * @param $min
 * @return bool
 */
function hasLengthGreaterThan($value, $min): bool
{
    $length = strlen($value);
    return $length > $min;
}

// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
/**
 * @param $value
 * @param $max
 * @return bool
 */
function hasLengthLessThan($value, $max): bool
{
    $length = strlen($value);
    return $length < $max;
}

// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
/**
 * @param $value
 * @param $exact
 * @return bool
 */
function hasLengthExactly($value, $exact): bool
{
    $length = strlen($value);
    return $length == $exact;
}


// * validate string length
// * combines functions_greater_than, _less_than, _exactly
// * spaces count towards length
// * use trim() if spaces should not count
/**
 * @param $value
 * @param $options
 * @return bool
 */
function hasLength($value, $options): bool
{
    if(isset($options['min']) && !hasLengthGreaterThan($value, $options['min'] - 1)) {
        return false;
    } elseif(isset($options['max']) && !hasLengthLessThan($value, $options['max'] + 1)) {
        return false;
    } elseif(isset($options['exact']) && !hasLengthExactly($value, $options['exact'])) {
        return false;
    } else {
        return true;
    }
}

// has_inclusion_of( 5, [1,3,5,7,9] )
// * validate inclusion in a set
/**
 * @param $value
 * @param $set
 * @return bool
 */
function hasInclusionOf($value, $set): bool
{
    return in_array($value, $set);
}

// has_exclusion_of( 5, [1,3,5,7,9] )
// * validate exclusion from a set
/**
 * @param $value
 * @param $set
 * @return bool
 */
function hasExclusionOf($value, $set): bool
{
    return !in_array($value, $set);
}

// has_string('nobody@nowhere.com', '.com')
// * strpos is faster than preg_match()
/**
 * @param $value
 * @param $required_string
 * @return bool
 */
function hasString($value, $required_string): bool
{
    return strpos($value, $required_string);
}

// has_valid_email_format('nobody@nowhere.com')
// * validate correct format for email addresses
/**
 * @param $value
 * @return bool
 */
function hasValidEmailFormat($value): bool
{
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
}