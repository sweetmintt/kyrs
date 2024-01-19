<?php
include "bd.php";

// Получаем общее количество записей в таблице picnic
$totalRows = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM picnic"));

// Устанавливаем количество записей, отображаемых на одной странице
$perPage = 12;

// Получаем текущую страницу (если не указана, то по умолчанию будет первая страница)
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Рассчитываем смещение для очередной страницы
$offset = ($currentPage - 1) * $perPage;

$query = "SELECT ObjectName, Address, HasEquipmentRental, HasEatery, HasToilet, HasWifi,  Paid FROM picnic";
$where = "";
$params = array();

if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $where .= "(ObjectName LIKE ? OR Address LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if (isset($_GET['equipment'])) {
    if (!empty($where)) {
        $where .= " AND";
    }
    $where .= " HasEquipmentRental = 'да'";
}

if (isset($_GET['eatery'])) {
    if (!empty($where)) {
        $where .= " AND";
    }
    $where .= " HasEatery = 'да'";
}

if (isset($_GET['toilet'])) {
    if (!empty($where)) {
        $where .= " AND";
    }
    $where .= " HasToilet = 'да'";
}

if (isset($_GET['wifi'])) {
    if (!empty($where)) {
        $where .= " AND";
    }
    $where .= " HasWifi = 'да'";
}

if (!empty($where)) {
    $query .= " WHERE $where";
}

$query .= " LIMIT $offset, $perPage";


// Создаем подготовленное выражение со всеми параметрами
$stmt = mysqli_prepare($connection, $query);
if ($stmt === false) {
    die('Ошибка выполнения запроса: ' . mysqli_error($connection));
}

// Привязываем значения параметров к подготовленному выражению
if (!empty($params)) {
    $types = str_repeat('s', count($params));
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

// Выполняем запрос
$result = mysqli_stmt_execute($stmt);
if ($result === false) {
    die('Ошибка выполнения запроса: ' . mysqli_error($connection));
}

// Получаем результаты запроса
$result = mysqli_stmt_get_result($stmt);

// Сохраняем полученные данные в массиве
$picnicData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $picnicData[] = $row;
}

// Закрываем подготовленное выражение
mysqli_stmt_close($stmt);

// Закрываем соединение с базой данных
mysqli_close($connection);
?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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
            <h2>Места</h2>
            <form id="search-form" action="mesta.php" method="get">
                <input type="text" id="search" name="search" placeholder="Поиск по названию">
                <div class="checkbox-container">
            <label class="checkbox-label">
            <input type="checkbox" name="equipment" value="1">
                Прокат оборудования
            </label>
            <label class="checkbox-label">
                <input type="checkbox" name="eatery" value="1">
                Наличие точки питания
            </label>
            <label class="checkbox-label">
                <input type="checkbox" name="toilet" value="1">
                Наличие туалета
            </label>
            <label class="checkbox-label">
                <input type="checkbox" name="wifi" value="1">
                Наличие точки Wi-Fi
            </label>
                </div>
            <input type="submit" value="Найти">
            </form>
            <div id="search-results"></div>
            <table>
                <thead>
                    <tr>
                      
                    <th>Название</th>
                        <th>Адрес</th>
                        <th>Возможность проката оборудования</th>
                        <th>Наличие точки питания</th>
                        <th>Наличие туалета</th>
                        <th>Наличие точки Wi-Fi</th>
                        <th>Форма посещения (платность)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($picnicData as $picnic) { ?>
                    <tr onclick="showPopup('<?php echo $picnic['ObjectName']; ?>', '<?php echo $picnic['Address']; ?>', '<?php echo $picnic['HasEquipmentRental']; ?>',
                        '<?php echo $picnic['HasEatery']; ?>', '<?php echo $picnic['HasToilet']; ?>', '<?php echo $picnic['HasWifi']; ?>', '<?php echo $picnic['Paid']; ?>')">
                        <td><?php echo $picnic['ObjectName']; ?></td>
                        <td><?php echo $picnic['Address']; ?></td>
                        <td><?php echo $picnic['HasEquipmentRental']; ?></td>
                        <td><?php echo $picnic['HasEatery']; ?></td>
                        <td><?php echo $picnic['HasToilet']; ?></td>
                        <td><?php echo $picnic['HasWifi']; ?></td>
                        <td><?php echo $picnic['Paid']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <?php
            // Рассчитываем общее количество страниц
            $totalPages = ceil($totalRows / $perPage);

            // Выводим ссылки на страницы
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<a href="mesta.php?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
    </main>
</body>
</html>


