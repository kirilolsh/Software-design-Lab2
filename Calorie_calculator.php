<?php require 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Калькулятор калорій</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Калькулятор калорій</h2>
    <form method="post" action="save.php">
        <label>Стать:</label>
        <select name="gender">
            <option value="male">Чоловік</option>
            <option value="female">Жінка</option>
        </select>

        <label>Вага (кг):</label>
        <input type="number" step="0.1" name="weight" required>

        <label>Зріст (см):</label>
        <input type="number" step="0.1" name="height" required>

        <label>Вік (років):</label>
        <input type="number" name="age" required>

        <label>Рівень активності:</label>
        <select name="activity">
            <option value="sedentary">Мінімальна активність</option>
            <option value="lightly">Легкі тренування (1-3 рази/тиждень)</option>
            <option value="moderately">Середні тренування (3-5 разів/тиждень)</option>
            <option value="very">Інтенсивні тренування (6-7 разів/тиждень)</option>
            <option value="extra">Дуже висока активність</option>
        </select>

        <input type="submit" value="Розрахувати">

        <p class = "describe">Після натискання клавіші "Розрахувати", вся інформація зберігається по посиланню нижче "Переглянути історію"</p>
    </form>

    <div style="text-align:center; margin-top: 20px;">
        <a href="history.php">Переглянути історію</a>
    </div>
</div>
</body>
</html>

