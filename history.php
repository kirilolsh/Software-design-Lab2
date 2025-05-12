<?php global $db;
require 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Історія розрахунків</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Історія розрахунків</h2>
    <table class="table">
        <tr>
            <th>Дата</th>
            <th>Стать</th>
            <th>Вага</th>
            <th>Зріст</th>
            <th>Вік</th>
            <th>Активність</th>
            <th>Калорії</th>
        </tr>
        <?php
        $stmt = $db->query("SELECT * FROM calculations ORDER BY created_at DESC");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
            ?>
            <tr>
                <td><?= $row['created_at'] ?></td>
                <td><?= $row['gender'] ?></td>
                <td><?= $row['weight'] ?> кг</td>
                <td><?= $row['height'] ?> см</td>
                <td><?= $row['age'] ?> років</td>
                <td><?= $row['activity'] ?></td>
                <td><?= round($row['calories']) ?> ккал</td>
            </tr>
        <?php endwhile; ?>
    </table>

    <h3 style="margin-top:30px;">Графік зміни калорій</h3>
    <canvas id="calorieChart"></canvas>
</div>

<script>
    <?php
    $stmt = $db->query("SELECT created_at, calories FROM calculations ORDER BY created_at");
    $dates = [];
    $calories = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $dates[] = $row['created_at'];
        $calories[] = round($row['calories']);
    }
    ?>
    const ctx = document.getElementById('calorieChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($dates) ?>,
            datasets: [{
                label: 'Калорії',
                data: <?= json_encode($calories) ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: { title: { display: true, text: 'Дата' } },
                y: { title: { display: true, text: 'Ккал' } }
            }
        }
    });
</script>
</body>
</html>

