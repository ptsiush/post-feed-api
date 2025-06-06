<?php
require_once './core/Database.php';

$pdo = Database::getInstance();

$pdo->exec("DROP TABLE IF EXISTS posts");
$pdo->exec("DROP TABLE IF EXISTS post_views");

$pdo->exec("CREATE TABLE posts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    created_at DATETIME NOT NULL,
    title TEXT NOT NULL,
    content TEXT NOT NULL,
    hotness REAL NOT NULL DEFAULT 0,
    views INTEGER NOT NULL DEFAULT 0
)");

$pdo->exec("CREATE TABLE post_views (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    post_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    viewed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(post_id, user_id)
)");

$insert = $pdo->prepare("INSERT INTO posts (created_at, title, content, hotness) VALUES (?, ?, ?, ?)");

for ($i = 1; $i <= 5000; $i++) {
    $insert->execute([
        date('Y-m-d H:i:s', strtotime("-$i hours")),
        "Post Title $i",
        "Content of post $i",
        mt_rand(10, 1000) / 10
    ]);
}

echo "Done";
