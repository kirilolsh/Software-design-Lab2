<?php
$db = new PDO('sqlite:data.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("CREATE TABLE IF NOT EXISTS calculations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    gender TEXT,
    weight REAL,
    height REAL,
    age INTEGER,
    activity TEXT,
    calories REAL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");
?>
