<?php

namespace Tests;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Permission;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Authenticate a user.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable|integer|null $user
     * @return $this
     */
    public function signIn($user = null)
    {
        if (! $user) {
            $user = factory(User::class)->create();
        } else if (! $user instanceof Authenticatable) {
            $user = User::findOrFail($user);
        }

        return $this->actingAs($user);
    }

    /**
     * Give a permission to the authenticated user.
     *
     * @param string $permission
     * @return $this
     */
    public function givePermissionTo($permission)
    {
        optional(auth()->user())->givePermissionTo(Permission::findOrCreate($permission));

        return $this;
    }
}
