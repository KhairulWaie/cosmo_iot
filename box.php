<!DOCTYPE html>
<html>
<head>
    <title>Sensor Box Viewer with Map</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Leaflet.js (Map) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        .sensor-card {
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }
        #map {
            height: 400px;
            width: 100%;
            border-radius: 8px;
        }
    </style>
</head>
<body class="bg-light">

<div class="container my-5">
<?php
    $boxId = $_GET['box'] ?? '634ec04a6c6fdf001bde2b8c';
    $api_url = "https://api.opensensemap.org/boxes/$boxId";
    $json = @file_get_contents($api_url);

    if (!$json) {
        echo "<div class='alert alert-danger'>❌ Failed to load data for box ID: $boxId</div>";
        exit;
    }

    $box = json_decode($json, true);
    $name = htmlspecialchars($box['name']);
    $coords = $box['currentLocation']['coordinates'] ?? [0, 0];
    $lon = $coords[0];
    $lat = $coords[1];
?>

    <div class="card sensor-card p-4">
        <h3>📦 Sensor Box: <strong><?= $name ?></strong></h3>
        <p>📍 <strong>Lat:</strong> <?= $lat ?> | <strong>Lon:</strong> <?= $lon ?></p>

        <!-- Map -->
        <div id="map" class="my-3"></div>
    </div>

    <div class="row mt-4">
    <?php foreach ($box['sensors'] as $sensor): 
        $title = htmlspecialchars($sensor['title']);
        $unit = $sensor['unit'] ?? '';
        $value = $sensor['lastMeasurement']['value'] ?? 'N/A';
        $createdAt = $sensor['lastMeasurement']['createdAt'] ?? 'N/A';
    ?>
        <div class="col-md-4">
            <div class="card sensor-card p-3">
                <h5><?= $title ?></h5>
                <p><strong>Value:</strong> <?= $value . ' ' . $unit ?></p>
                <small class="text-muted">Last update: <?= $createdAt ?></small>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>

<script>
    // Initialize map
    const lat = <?= $lat ?>;
    const lon = <?= $lon ?>;

    const map = L.map('map').setView([lat, lon], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.marker([lat, lon]).addTo(map).bindPopup("<?= addslashes($name) ?>").openPopup();
</script>

</body>
</html>
