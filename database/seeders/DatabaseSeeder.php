<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Comment;
use App\Models\State;
use App\Models\Tag;
use Database\Factories\ArticleFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $tags = Tag::factory(10)->create();

        $articles = Article::factory(20)->create();

        $tags_id = $tags->pluck('id');

        $articles->each(function ($article) use ($tags_id) {
            $article->tags()->attach($tags_id->random(3));
            Comment::factory(3)->create([
                'article_id' => $article->id
            ]);

            State::factory(1)->create([
                'article_id' => $article->id
            ]);
        });
    }
}
