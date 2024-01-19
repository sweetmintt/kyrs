<?php
include 'bd.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

if (mysqli_query($connection, $sql)) {
  header("Location: index.php");
} else {
  echo '<script>alert("Ошибка регистрации"); window.location.href = "vxod.php";</script>';
}

mysqli_close($connection);
?>
