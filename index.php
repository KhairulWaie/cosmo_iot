<!DOCTYPE html>
<html>
<head>
    <title>OpenSenseMap Dashboard (Auto-Refresh)</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .sensor-card {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .chart-container {
            position: relative;
            height: 400px;
        }
        #countdown {
            font-size: 1.2rem;
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body class="bg-light">

<div class="container my-5">
    <h2 class="text-center mb-4">📊 OpenSenseMap Dashboard</h2>
    <div class="text-center mb-4">
        ⏳ Auto-refresh in <span id="countdown">15</span> seconds...
    </div>

    <!-- Sensor Cards -->
    <div id="sensorCards" class="row"></div>

    <!-- Chart -->
    <div class="card mt-4 p-4">
        <h5>Sensor Readings Overview</h5>
        <div class="chart-container">
            <canvas id="sensorChart"></canvas>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    let countdown = 15;
    let countdownElement = document.getElementById('countdown');
    let chart = null;

    // Fetch and render data
    function fetchData() {
        fetch('data.php')
            .then(response => response.json())
            .then(data => {
                renderCards(data);
                renderChart(data);
            });
    }

    // Render cards
    function renderCards(data) {
        const container = document.getElementById('sensorCards');
        container.innerHTML = '';
        data.sensors.forEach(sensor => {
            const card = document.createElement('div');
            card.className = 'col-md-4';
            card.innerHTML = `
                <div class="card sensor-card p-3">
                    <h5>${sensor.title}</h5>
                    <p><strong>Value:</strong> ${sensor.value} ${sensor.unit}</p>
                </div>
            `;
            container.appendChild(card);
        });
    }

    // Render chart
    function renderChart(data) {
        const labels = data.sensors.map(s => s.title);
        const values = data.sensors.map(s => parseFloat(s.value));

        if (chart) chart.destroy(); // clear previous chart

        const ctx = document.getElementById('sensorChart').getContext('2d');
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Sensor Values',
                    data: values,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 8
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Countdown timer and auto-refresh
    function startCountdown() {
        setInterval(() => {
            countdown--;
            countdownElement.textContent = countdown;
            if (countdown === 0) {
                fetchData();
                countdown = 15;
            }
        }, 1000);
    }

    // Initialize
    fetchData();
    startCountdown();
</script>

</body>
</html>
