<!DOCTYPE html>
<html>
    <head>
        <title>New Empty PHP</title>
    </head>
    <body>
        <?php
        require_once 'vendor/autoload.php';
        include('auth.php');

        $is_loop_time = 1;
        include('db.php');
        ?>
    </body>
</html>
