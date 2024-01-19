<!DOCTYPE html>
<html>
<head>
    <title>Пикники</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
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
    <body>
    <div class="tabcontent">
    <h2>Найдите идеальное место для пикника вместе с нами!</h2>
    <p> Наш сайт предлагает удобный поиск мест для пикника. Мы собрали для вас самые красивые и уютные локации, где вы сможете насладиться солнцем, свежим воздухом и приятной компанией.</p>
    <div id="map-container">
    <div id="map-container" style="height: 400px;"></div>
        </div>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    ...
<script>
    // Создаем карту
    var map = L.map('map-container').setView([55.592850559, 37.585807091], 12);

    // Добавляем слой карты OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'OpenStreetMap',
        maxZoom: 18,
    }).addTo(map);

    // Загружаем данные из JSON-файла
    fetch('features.json')
        .then(function(response) {
            return response.json();
        })
        .then(function(data) {
            // Перебираем каждый объект в массиве features
            data.features.forEach(function(feature) {
                var coordinates = feature.geometry.coordinates;
                var name = feature.properties.attributes.ObjectName;

                // Создаем маркер для каждой точки
                var marker = L.marker([coordinates[1], coordinates[0]]).addTo(map);
                marker.bindPopup(name);
            });
        });
</script>
...

</body>
</html>