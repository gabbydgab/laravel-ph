<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MediaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_upload_a_file()
    {
        Storage::fake('public');

        $this->signIn();

        $values = ['file' => UploadedFile::fake()->image('foo.png')];

        $response = $this->post(route('media.store'), $values)->assertSuccessful();

        Storage::disk('public')->assertExists($response->json('data.path'));
    }
}
