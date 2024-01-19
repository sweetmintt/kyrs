<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kyrs";

// Создаем соединение
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Проверяем соединение
if (!$connection) {
    die("Ошибка соединения: " . mysqli_connect_error());
}
?>
