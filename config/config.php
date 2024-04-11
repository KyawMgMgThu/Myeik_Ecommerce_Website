<?php
/*if (!isset($_SERVER['HTTP_REFERER'])) {
    header('location: http://localhost:8000/');
    exit;
} */
try {

    //Host
    $host = 'localhost';
    //DBname
    $dbname = 'Ecommerce';
    //User
    $user = 'kyawmgmgthu';
    //Password
    $password = 'kyawmgmgthu789';
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

    /* if ($conn == true) {
        echo "connected Successfully";
    } else {
        echo "404 Not Found";
    }*/
} catch (PDOException $e) {
    echo $e->getMessage();
}
