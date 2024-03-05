<?php
require("autoload.php");
ini_set('memory_limit', '-1');
$weather = new Weather();
$egyptian_cities = $weather->get_cities();

if (isset($_POST["city"])) {
    $selected_city = $_POST["city"];
    $weather_data = $weather->get_weather($selected_city);
    $current_time = $weather->get_current_time();
    $current_date = $weather->get_current_date();

    echo "<h2>{$egyptian_cities[$selected_city]} Weather Status</h2>";
    echo "<p>{$current_time}</p>";
    echo "<p>{$current_date}</p>";
    echo "<p>Weather Status: {$weather_data['weather'][0]['description']}</p>";
    echo "<img src='http://openweathermap.org/img/w/{$weather_data['weather'][0]['icon']}.png' alt='Weather Icon'>";
    echo "<p>Min Temperature: {$weather_data['main']['temp_min']} &deg;C</p>";
    echo "<p>Max Temperature: {$weather_data['main']['temp_max']} &deg;C</p>";
    echo "<p>Humidity: {$weather_data['main']['humidity']}%</p>";
    echo "<p>Wind: {$weather_data['wind']['speed']} m/s</p>";
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Weather App</title>
</head>
<body>
    <form method="post" action="">
        <h4>Weather Forecast</h4>
        <label for="city"></label>
        <select name="city">
            <?php
            foreach ($egyptian_cities as $cityId => $cityName) {
                echo "<option value='$cityId'>$cityName</option>";
            }
            ?>
        </select>
        <input type="submit" value="Get Weather">
    </form>
</body>
</html>
