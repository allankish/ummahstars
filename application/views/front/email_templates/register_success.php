<html>
    <head>
        <title>
            Registration successfully - Ummahstars.com
        </title>
    </head>
    <body>
        <p>Hello <?php echo $uname; ?>,<br /><br />Welcome to Ummahstars.com<br />
            Please click the below link to confirm your email id. <br />
            <a href="<?php echo $reset_link; ?>"><?php echo $reset_link; ?></a>
        </p>
        <p>
            <strong>Your login details:</strong><br />
            Username: <?php echo $email_id; ?><br />
            Password: <?php echo $password; ?>
        </p>
        <p>Thanks,<br />Ummahstars.com</p>
    </body>
</html>