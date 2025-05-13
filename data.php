<?php
header('Content-Type: application/json');

$api_url = 'https://api.opensensemap.org/boxes/634ec04a6c6fdf001bde2b8c';
$response = file_get_contents($api_url);

if ($response === FALSE) {
    echo json_encode(['error' => 'Failed to fetch API']);
    exit;
}

$data = json_decode($response, true);
$result = [
    'boxName' => $data['name'],
    'sensors' => []
];

foreach ($data['sensors'] as $sensor) {
    $value = $sensor['lastMeasurement']['value'] ?? null;
    if (is_numeric($value)) {
        $result['sensors'][] = [
            'title' => $sensor['title'],
            'value' => $value,
            'unit' => $sensor['unit']
        ];
    }
}

echo json_encode($result);
