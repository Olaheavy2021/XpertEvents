<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta HTTP-EQUIV="X-UA-COMPATIBLE" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo urlFor('/stylesheets/admin_style.css'); ?>">
    <link rel="stylesheet" href="<?php echo urlFor('/stylesheets/profile_style.css'); ?>">
    <link rel="stylesheet" href="<?php echo urlFor('/stylesheets/events_style.css'); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
          integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <title>XpertEvents Admin</title>
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