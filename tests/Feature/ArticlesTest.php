<?php

namespace Tests\Feature;

use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_visit_all_articles_page()
    {
        $article = factory(Article::class)->create();

        $this->get(route('articles.index'))
            ->assertSuccessful()
            ->assertSee(route('articles.show', $article));
    }

    /** @test */
    public function a_user_can_visit_an_article_page()
    {
        $article = factory(Article::class)->create();

        $this->get(route('articles.show', $article))
            ->assertSuccessful();
    }

    /** @test */
    public function a_user_can_visit_create_article_page()
    {
        $this->signIn()
            ->givePermissionTo('create articles')
            ->get(route('articles.create'))
            ->assertSuccessful();
    }

    /** @test */
    public function a_user_can_create_an_article()
    {
        $values = factory(Article::class)->raw();

        $this->signIn($values['author_id'])
            ->givePermissionTo('create articles');

        $this->post(route('articles.store'), $values);

        $this->assertDatabaseHas('articles', $values);
    }

    /** @test */
    public function a_user_can_visit_edit_article_page()
    {
        $this->withoutExceptionHandling();

        $article = factory(Article::class)->create();

        $this->signIn($article->author)
            ->givePermissionTo('edit articles')
            ->get(route('articles.edit', $article))
            ->assertSuccessful();
    }

    /** @test */
    public function a_user_can_update_an_article()
    {
        $article = factory(Article::class)->create();

        $this->signIn($article->author)
            ->givePermissionTo('edit articles');

        $values = factory(Article::class)->raw();

        unset($values['author_id']);

        $this->patch(route('articles.update', $article), $values);

        $this->assertDatabaseHas('articles', $values);
    }

    /** @test */
    public function a_user_can_delete_an_article()
    {
        $article = factory(Article::class)->create();

        $this->signIn($article->author)
            ->givePermissionTo('delete articles');

        $this->delete(route('articles.destroy', $article));

        $this->assertDatabaseMissing('articles', $article->only('id'));
    }

    /** @test */
    public function a_user_should_not_see_unpublished_articles_in_all_articles_page()
    {
        $article = factory(Article::class)->create(['published_at' => null]);

        $this->get(route('articles.index'))
            ->assertSuccessful()
            ->assertDontSee(route('articles.show', $article));
    }

    /** @test */
    public function a_user_can_not_visit_an_unpublished_article_page()
    {
        $article = factory(Article::class)->create(['published_at' => null]);

        $this->get(route('articles.show', $article))
            ->assertNotFound();
    }

    /** @test */
    public function only_users_with_create_articles_permission_can_create_an_article()
    {
        $this->signIn();

        $this->post(route('articles.store'))->assertForbidden();
    }

    /** @test */
    public function only_authors_with_edit_articles_permission_can_edit_an_article()
    {
        $article = factory(Article::class)->create();

        // not the author and no edit articles permission
        $this->signIn()
            ->patch(route('articles.update', $article))
            ->assertForbidden();

        // not the author but with edit articles permission
        $this->givePermissionTo('edit articles')
            ->patch(route('articles.update', $article))
            ->assertForbidden();

        // author but no edit articles permission
        $this->signIn($article->author)
            ->patch(route('articles.update', $article))
            ->assertForbidden();
    }

    /** @test */
    public function only_authors_with_delete_articles_permission_can_delete_an_article()
    {
        $article = factory(Article::class)->create();

        // not the author and no edit articles permission
        $this->signIn()
            ->delete(route('articles.destroy', $article))
            ->assertForbidden();

        // not the author but with edit articles permission
        $this->givePermissionTo('delete articles')
            ->delete(route('articles.destroy', $article))
            ->assertForbidden();

        // author but no edit articles permission
        $this->signIn($article->author)
            ->delete(route('articles.destroy', $article))
            ->assertForbidden();
    }

    /** @test */
    public function tags_can_be_added_when_creating_articles()
    {
        $values = factory(Article::class)->raw(['tags' => ['Laravel']]);

        $this->signIn($values['author_id'])->givePermissionTo('create articles');

        $this->post(route('articles.store'), $values);

        $this->assertCount(1, Article::first()->tags);
    }

    /** @test */
    public function tags_can_be_updated_when_editing_articles()
    {
        $article = factory(Article::class)->create();

        $this->signIn($article->author)->givePermissionTo('edit articles');

        $values = factory(Article::class)->raw(['tags' => ['Laravel']]);

        $this->patch(route('articles.update', $article), $values);

        $this->assertCount(1, $article->fresh()->tags);
    }

    /** @test */
    public function unauthenticated_user_can_not_like_an_article()
    {
        $article = factory(Article::class)->create();

        $this->post(route('articles.show', $article) . '/likes')
            ->assertRedirect(route('login'));

        $this->delete(route('articles.show', $article) . '/likes')
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function a_user_can_like_an_article()
    {
        $this->withoutExceptionHandling();

        $article = factory(Article::class)->create();

        $this->signIn();

        $this->post(route('articles.show', $article) . '/likes');

        $this->assertCount(1, $article->fresh()->likes);
        $this->assertEquals(1, $article->fresh()->likes_count);
    }

    /** @test */
    public function a_user_can_unlike_an_article()
    {
        $this->withoutExceptionHandling();

        $article = factory(Article::class)->create();

        $this->signIn();

        $article->like(auth()->user());

        $this->delete(route('articles.show', $article) . '/likes');

        $this->assertCount(0, $article->fresh()->likes);
        $this->assertEquals(0, $article->fresh()->likes_count);
    }

    /** @test */
    public function a_user_can_only_like_an_article_once()
    {
        $this->withoutExceptionHandling();

        $article = factory(Article::class)->create();

        $this->signIn();

        $article->like(auth()->user());

        $this->post(route('articles.show', $article) . '/likes');

        $this->assertCount(1, $article->fresh()->likes);
        $this->assertEquals(1, $article->fresh()->likes_count);
    }
}
