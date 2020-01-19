<?php

namespace Tests\Unit;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_an_author()
    {
        $article = factory(Article::class)->create();

        $this->assertInstanceOf(User::class, $article->author);
    }

    /** @test */
    public function it_has_tags()
    {
        $article = factory(Article::class)->create();

        $this->assertInstanceOf(Collection::class, $article->tags);
    }

    /** @test */
    public function it_can_get_tag_names()
    {
        $article = factory(Article::class)->create();

        $article->syncTags(['Laravel']);

        $this->assertEquals(['Laravel'], $article->getTagNames());
    }

    /** @test */
    public function it_can_get_the_next_record()
    {
        $articles = factory(Article::class, 2)->create();

        $this->assertTrue($articles[0]->nextRecord()->is($articles[1]));
    }

    /** @test */
    public function it_can_get_the_previous_record()
    {
        $articles = factory(Article::class, 2)->create();

        $this->assertTrue($articles[1]->previousRecord()->is($articles[0]));
    }

    /** @test */
    public function it_can_sync_tags()
    {
        $article = factory(Article::class)->create();

        $article->syncTags(['Laravel']);

        $this->assertCount(1, $article->tags);

        $article->syncTags(['Laravel', 'Testing']);

        $this->assertCount(2, $article->fresh()->tags);
    }
}
