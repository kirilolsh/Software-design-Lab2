<?php
global $db;
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gender = $_POST['gender'];
    $weight = (float)$_POST['weight'];
    $height = (float)$_POST['height'];
    $age = (int)$_POST['age'];
    $activity = $_POST['activity'];

    $bmr = ($gender === 'male')
        ? 10 * $weight + 6.25 * $height - 5 * $age + 5
        : 10 * $weight + 6.25 * $height - 5 * $age - 161;

    $activity_multipliers = [
        'sedentary' => 1.2,
        'lightly' => 1.375,
        'moderately' => 1.55,
        'very' => 1.725,
        'extra' => 1.9
    ];

    $calories = $bmr * ($activity_multipliers[$activity] ?? 1.2);

    $stmt = $db->prepare("INSERT INTO calculations (gender, weight, height, age, activity, calories) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$gender, $weight, $height, $age, $activity, $calories]);

    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?calories=' . round($calories));
    exit;
}
?>

