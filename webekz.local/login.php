<?php
include 'bd.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) > 0) {
  session_start();
  $_SESSION['email'] = $email;
  // перенаправление на индекс
  header("Location: index2.php");
} else {
  // вывод всплывающего окна с сообщением
  echo '<script>alert("Неверный email или пароль"); window.location.href = "vxod.php";</script>';
}

mysqli_close($connection);
?>
