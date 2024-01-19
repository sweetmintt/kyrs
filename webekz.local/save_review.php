<?php
include "bd.php";

// Получение данных из POST-запроса
$name = $_POST['name'];
$place = $_POST['place'];
$rating = $_POST['rating'];
$review = $_POST['review'];

// Запрос на вставку данных в таблицу
$insert_query = "INSERT INTO reviews (name, place, rating, review) VALUES ('$name', '$place', '$rating', '$review')";
if ($connection->query($insert_query) === TRUE) {
  echo "Отзыв сохранен успешно!";
} else {
  echo "Ошибка при сохранении отзыва: " . $connection->error;
}

// Закрываем соединение с базой данных
$connection->close();
?>
