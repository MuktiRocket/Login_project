<?php

try {
    $pdo = new PDO('mysql: host=localhost;port=3306;dbname=login_project', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "connection failed" . $e->getMessage();
}
