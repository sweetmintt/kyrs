<?php
include "bd.php";

$searchQuery = $_GET['search'];
$equipment = isset($_GET['equipment']) ? $_GET['equipment'] : 0;
$eatery = isset($_GET['eatery']) ? $_GET['eatery'] : 0;
$toilet = isset($_GET['toilet']) ? $_GET['toilet'] : 0;
$wifi = isset($_GET['wifi']) ? $_GET['wifi'] : 0;

$where = "";

if ($equipment) {
    $where .= "HasEquipmentRental = 1 AND ";
}

if ($eatery) {
    $where .= "HasEatery = 1 AND ";
}

if ($toilet) {
    $where .= "HasToilet = 1 AND ";
}

if ($wifi) {
    $where .= "HasWifi = 1 AND ";
}

// Удаляем последние "AND" из строки условий
$where = rtrim($where, " AND ");

$query = "SELECT ObjectName, Address, HasEquipmentRental, HasEatery, HasToilet, HasWifi, Seats, Paid FROM picnic WHERE $where AND ObjectName LIKE '%$searchQuery%' LIMIT $perPage OFFSET $offset";

$result = mysqli_query($connection, $query);

if (!$result) {
    die("Ошибка выполнения запроса: " . mysqli_error($connection));
}

$picnicData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $picnicData[] = $row;
}

mysqli_close($connection);

foreach ($picnicData as $picnic) { ?>
    <tr onclick="showPopup('<?php echo $picnic['ObjectName']; ?>', '<?php echo $picnic['Address']; ?>', '<?php echo $picnic['HasEquipmentRental']; ?>', '<?php echo $picnic['HasEatery']; ?>',
    '<?php echo $picnic['HasToilet']; ?>', '<?php echo $picnic['HasWifi']; ?>', '<?php echo $picnic['Seats']; ?>', '<?php echo $picnic['Paid']; ?>')">
        <td><?php echo $picnic['ObjectName']; ?></td>
        <td><?php echo $picnic['Address']; ?></td>
        <td><?php echo $picnic['HasEquipmentRental']; ?></td>
        <td><?php echo $picnic['HasEatery']; ?></td>
        <td><?php echo $picnic['HasToilet']; ?></td>
        <td><?php echo $picnic['HasWifi']; ?></td>
        <td><?php echo $picnic['Seats']; ?></td>
        <td><?php echo $picnic['Paid']; ?></td>
    </tr>
<?php } ?>
