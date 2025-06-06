<?php
class PostController
{
    public function feed()
    {
        header('Content-Type: application/json');
        $user_id = (int) ($_GET['user_id'] ?? 0);
        $posts = Post::getFeed($user_id);
        echo json_encode($posts);
    }

    public function viewed()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents("php://input"), true);

        $user_id = (int) ($data['user_id'] ?? 0);
        $post_id = (int) ($data['post_id'] ?? 0);

        if (!$user_id || !$post_id) {
            http_response_code(400);
            echo json_encode(['error' => 'Invalid data']);
            return;
        }

        Post::markViewed($user_id, $post_id);
        echo json_encode(['status' => 'ok']);
    }
}
