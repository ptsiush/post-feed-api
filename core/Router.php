<?php
class Router
{
    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if (str_contains($uri, "/feed") && $method === 'GET') {
            (new PostController())->feed();
        } elseif ($uri === '/viewed' && $method === 'POST') {
            (new PostController())->viewed();
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Not found']);
        }
    }
}
