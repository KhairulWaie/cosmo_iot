<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">🌍 Sensor Dashboard</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <!-- Country Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="countryDropdown" role="button" data-toggle="dropdown">
                    Select Country
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">🇩🇪 Germany</a>
                    <a class="dropdown-item" href="#">🇺🇸 USA</a>
                    <a class="dropdown-item" href="#">🇬🇧 UK</a>
                    <a class="dropdown-item" href="#">🇯🇵 Japan</a>
                    <a class="dropdown-item" href="#">🇧🇳 Brunei</a>
                    <!-- Add more countries here -->
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-muted" href="#">Add more...</a>
                </div>
            </li>
        </ul>
    </div>
</nav>

<!-- Optional JS (Bootstrap requires jQuery & Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
