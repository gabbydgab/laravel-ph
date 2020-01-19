<?php

use App\Article;
use App\Tag;
use Illuminate\Database\Seeder;

class FakeArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        $tags = factory(Tag::class, 20)->create()
            ->pluck('name')
            ->all();

        factory(Article::class, 20)->create()
            ->each(function ($article) use ($faker, $tags) {
                $article->syncTags($faker->randomElements($tags, rand(1, 5)));
            });
    }
}
