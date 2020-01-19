<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_an_avatar()
    {
        $user = factory(User::class)->create(['avatar' => null]);

        $this->assertEquals('https://www.gravatar.com/avatar/' . md5($user->email), $user->avatar);

        $user->update(['avatar' => 'https://image.png']);

        $this->assertEquals('https://image.png', $user->avatar);
    }
}
