<!DOCTYPE html>
<html>
<head>
    <title>Пикники</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Главная</a>
            <a href="tips.php">Полезные советы</a>
            <a href="pack.php">Что взять на пикник</a>
            <a href="map.php">Карта</a>
            <a href="mesta.php">Места</a>
            <a href="vxod.php">Вход</a>
        </nav>
    </header>

    <main>
    <div class="tabcontent">
  <h2>Вход</h2>
  <div class="auth-form">
  <h3>Регистрация</h3>
  <form action="register.php" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="Зарегистрироваться">
  </form>

  <h3>Авторизация</h3>
  <form action="login.php" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="Войти">
  </form>
</div>
</div>
</div>
</main>
</body>
</html>

