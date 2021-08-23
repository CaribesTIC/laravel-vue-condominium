<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\UserTestable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrowserSessionsTest extends TestCase
{
    use RefreshDatabase, UserTestable;

    public function test_other_browser_sessions_can_be_logged_out()
    {
        $this->actingAs($user = UserTestable::userCommon());

        $response = $this->delete('/user/other-browser-sessions', [
            'password' => 'password',
        ]);

        $response->assertSessionHasNoErrors();
    }
}
