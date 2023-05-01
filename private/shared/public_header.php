<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xpert Events <?php if (isset($page_title)) {
            echo '- ' . removeSpecialChars($page_title);
        } ?></title>
    <link rel="stylesheet" media="all" href="<?php echo urlFor('/stylesheets/style.css'); ?>"/>
    <link rel="stylesheet" media="all" href="<?php echo urlFor('/stylesheets/contact_us_style.css'); ?>"/>
    <link rel="stylesheet" media="all" href="<?php echo urlFor('/stylesheets/register_style.css'); ?>"/>
    <link rel="stylesheet" media="all" href="<?php echo urlFor('/stylesheets/services_style.css'); ?>"/>
    <!--This is to display any message in the alert box-->
    <script type="application/javascript">
        var message = "<?php echo $_SESSION['message']; ?>";
        <?php
        global $session;
        $session->clear_message();
        ?>
        if (message !== "") {
            alert(message);
        }
    </script>
</head>
<body>