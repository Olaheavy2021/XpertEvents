<?php

/**
 * @return void
 */
function requireLogin(): void
{
    global $session;
    if(!$session->is_logged_in()) {
        redirectTo(urlFor('/homepage.php'));
    } else {
        // Do nothing, let the rest of the page proceed
    }
}

/**
 * @param array $errors
 * @return string
 */
function displayErrors(array $errors=array()): string
{
    $output = '';
    if(!empty($errors)) {
        $output .= "<div class=\"errors\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        foreach($errors as $error) {
            $output .= "<li>" . removeSpecialChars($error) . "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

/**
 * @return string|void
 */
function displaySessionMessage() {
    global $session;
    $msg = $session->message();
    if(isset($msg) && $msg != '') {
        $session->clear_message();
        return '<div id="message">' . h($msg) . '</div>';
    }
}
