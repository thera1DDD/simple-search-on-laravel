<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\Post;
use App\Models\Comment;

class LoadDataCommand extends Command
{
    protected $signature = 'load:data';
    protected $description = 'Load posts and comments data';

    public function handle()
    {
        try {
            $client = new Client([
                'verify' => false, // Игнорировать SSL-проверку
            ]);

            // Загрузка записей
            $posts_response = $client->get('https://jsonplaceholder.typicode.com/posts');
            $posts_data = json_decode($posts_response->getBody(), true);

            foreach ($posts_data as $post) {
                Post::create([
                    'title' => $post['title'],
                    'body' => $post['body'],
                ]);
            }

            // Загрузка комментариев
            $comments_response = $client->get('https://jsonplaceholder.typicode.com/comments');
            $comments_data = json_decode($comments_response->getBody(), true);

            foreach ($comments_data as $comment) {
                Comment::create([
                    'post_id' => $comment['postId'],
                    'name' => $comment['name'],
                    'email' => $comment['email'],
                    'body' => $comment['body'],
                ]);
            }

            $this->info("Загружено " . count($posts_data) . " записей и " . count($comments_data) . " комментариев");
        } catch (RequestException $e) {
            // Обработка ошибки
            $this->error($e->getMessage());
        }
    }
}
