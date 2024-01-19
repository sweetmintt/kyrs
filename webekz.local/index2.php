<?php
include "bd.php";
$query ='SELECT * FROM reviews';
$result = mysqli_query($connection, $query);
// Сохраняем полученные данные в массиве
$otz = array();
while ($row = mysqli_fetch_assoc($result)) {
    $otz[] = $row;
}
// Закрываем соединение с базой данных
mysqli_close($connection);
?>
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
            <a href="index2.php">Отзывы</a>
        </nav>
    </header>
    <main>
    <body>
    <div class="tabcontent">
<div>
  <label for="name">Имя:</label>
  <input type="text" id="name" name="name" required>
</div>
<div>
  <label for="place">Место:</label>
  <input type="text" id="place" name="place" required>
</div>
<div>
  <label for="rating">Рейтинг:</label>
  <select id="rating" name="rating" required>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
</div>
<div>
  <label for="review">Отзыв:</label>
  <textarea id="review" name="review" required></textarea>
</div>
<button id="submit-btn">Отправить отзыв</button>

<div id="message"></div>


<table>
    <thead>
      <tr>
        <th>Имя</th>
        <th>Место</th>
      <th>Рейтинг</th>
      <th>Отзывы</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($otz as $picnic) { ?>
      <tr onclick="showPopup('<?php echo $picnic['name']; ?>', '<?php echo $picnic['place']; ?>','<?php echo $picnic['raiting']; ?>','<?php echo $picnic['review']; ?>')">
      <td><?php echo $picnic['name']; ?></td>
        <td><?php echo $picnic['place'] ; ?></td>
        <td><?php echo $picnic['rating'] ; ?></td>
        <td><?php echo $picnic['review']; ?></td>
      <?php } ?>
    </tbody>
  </table>
</div>

<script src="script.js"></script>

</main>
</body>
</html>

