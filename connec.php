<?php
define('DSN', 'mysql:host=localhost;dbname=donkey_event_db');
define('USER', 'root');
define('PASS', '');

// Create connection to database
$pdo = new \PDO(DSN, USER, PASS, [
    PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
]);