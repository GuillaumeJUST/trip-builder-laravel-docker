<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use stdClass;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getHeaders(): array {
        $user = factory(User::class)->create(['email' => 'user@test.com']);
        $token = $user->generateToken();
        return ['Authorization' => "Bearer $token"];
    }
}
