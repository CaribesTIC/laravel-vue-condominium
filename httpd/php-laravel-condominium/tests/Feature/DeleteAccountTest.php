<?php
namespace Tests\Feature;

use Tests\TestCase;
use Tests\Feature\UserTestable;
use Laravel\Jetstream\Features;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;


class DeleteAccountTest extends TestCase
{
    use RefreshDatabase, UserTestable;

    public function test_user_accounts_can_be_deleted()
    {    
        if (! Features::hasAccountDeletionFeatures()) {
            return $this->markTestSkipped('Account deletion is not enabled.');
        }

        $this->actingAs($user = UserTestable::userAdmin());

        $response = $this->delete('/user', [
            'password' => 'password',
        ]);

        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_before_account_can_be_deleted()
    {
        if (! Features::hasAccountDeletionFeatures()) {
            return $this->markTestSkipped('Account deletion is not enabled.');
        }

        $this->actingAs($user = UserTestable::userCommon());

        $response = $this->delete('/user', [
            'password' => 'wrong-password',
        ]);

        $this->assertNotNull($user->fresh());
    }
}
