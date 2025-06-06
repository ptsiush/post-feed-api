<?php
class Post
{
    public static function getFeed($user_id)
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("
            SELECT p.*
            FROM posts p
            LEFT JOIN post_views pv ON pv.post_id = p.id AND pv.user_id = :user_id
            WHERE pv.id IS NULL AND p.views < 1000
            ORDER BY p.hotness DESC
            LIMIT 20
        ");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function markViewed($user_id, $post_id)
    {
        $pdo = Database::getInstance();
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT OR IGNORE INTO post_views (user_id, post_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $post_id]);

        $stmt = $pdo->prepare("UPDATE posts SET views = views + 1 WHERE id = ?");
        $stmt->execute([$post_id]);

        $pdo->commit();
    }
}
