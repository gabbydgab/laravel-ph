<?php

namespace Tests\Feature;

use App\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function unauthorized_user_may_not_manage_events()
    {
        $this->signIn();

        $event = factory(Event::class)->create();

        $this->post(route('events.store'))->assertForbidden();
        $this->patch(route('events.update', $event))->assertForbidden();
        $this->delete(route('events.destroy', $event))->assertForbidden();
    }

    /** @test */
    public function a_user_can_visit_all_events_page()
    {
        $this->withoutExceptionHandling();

        $event = factory(Event::class)->create();

        $this->get(route('events.index'))
            ->assertSuccessful()
            ->assertSee(route('events.show', $event));
    }

    /** @test */
    public function a_user_can_visit_an_event_page()
    {
        $this->withoutExceptionHandling();

        $event = factory(Event::class)->create();

        $this->get(route('events.show', $event))
            ->assertSuccessful();
    }

    /** @test */
    public function a_user_can_visit_create_event_page()
    {
        $this->withoutExceptionHandling();

        $this->signIn()->givePermissionTo('create events');

        $this->get(route('events.create'))->assertSuccessful();
    }

    /** @test */
    public function a_user_can_create_an_event()
    {
        $this->withoutExceptionHandling();

        $values = factory(Event::class)->raw();

        $this->signIn()->givePermissionTo('create events');

        $this->post(route('events.store'), $values);

        $this->assertDatabaseHas('events', $values);
    }

    /** @test */
    public function a_user_can_visit_edit_event_page()
    {
        $this->withoutExceptionHandling();

        $event = factory(Event::class)->create();

        $this->signIn()->givePermissionTo('edit events');

        $this->get(route('events.edit', $event))->assertSuccessful();
    }

    /** @test */
    public function a_user_can_update_an_event()
    {
        $this->withoutExceptionHandling();

        $event = factory(Event::class)->create();

        $this->signIn()->givePermissionTo('edit events');

        $values = factory(Event::class)->raw();

        $this->patch(route('events.update', $event), $values);

        $this->assertDatabaseHas('events', $values);
    }

    /** @test */
    public function a_user_can_delete_an_event()
    {
        $this->withoutExceptionHandling();

        $event = factory(Event::class)->create();

        $this->signIn()->givePermissionTo('delete events');

        $this->delete(route('events.destroy', $event));

        $this->assertDatabaseMissing('events', $event->only('id'));
    }
}
