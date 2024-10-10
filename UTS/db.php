<?php
    define('DSN', 'mysql:host=localhost;dbname=todo');
    define('DBUSER', 'root');
    define('DBPASS', '');
    $db = new PDO(DSN, DBUSER, DBPASS);
?>