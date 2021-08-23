<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\UserTestable;
use Laravel\Jetstream\Jetstream;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Providers\RouteServiceProvider;


class RegistrationTest extends TestCase
{
    use RefreshDatabase, UserTestable;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    /*public function test_new_users_can_register()
    {
        $this->actingAs(UserTestable::userAdmin());
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);
    }*/
}
