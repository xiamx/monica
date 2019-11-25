<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Account\Account;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class InstanceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * If an instance sets `disable_signup` env variable to true, it should hide
     * the signup button on the Sign in page.
     * Also, trying to reach `/register` should lead to a 403 page.
     *
     * @return void
     */
    public function test_disable_signup_set_to_true_hides_signup_button_and_register_page()
    {
        config(['monica.disable_signup' => true]);
        factory(Account::class)->create();

        $response = $this->get('/');
        $response->assertDontSee(
            'Sign up'
        );
    }
}
