<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\UserTestable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase, UserTestable;

    public function test_profile_information_can_be_updated()
    {
        $this->actingAs($user = UserTestable::userAdmin());

        $response = $this->put('/user/profile-information', [
            'name' => 'Test Name',
            'email' => 'test@example.com',
        ]);

        $this->assertEquals('Test Name', $user->fresh()->name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }
}
