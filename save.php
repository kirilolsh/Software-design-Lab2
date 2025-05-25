<?php
global $db;
require 'db.php';
require 'CalorieCalculator.php'; // Додаємо підключення нового класу

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gender = $_POST['gender'];
    $weight = (float)$_POST['weight'];
    $height = (float)$_POST['height'];
    $age = (int)$_POST['age'];
    $activity = $_POST['activity'];

    // Створюємо екземпляр класу CalorieCalculator та використовуємо його для обчислень
    $calculator = new CalorieCalculator();
    $calories = $calculator->calculateCalories($gender, $weight, $height, $age, $activity);

    $stmt = $db->prepare("INSERT INTO calculations (gender, weight, height, age, activity, calories) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$gender, $weight, $height, $age, $activity, $calories]);

    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?calories=' . round($calories));
    exit;
}
?>