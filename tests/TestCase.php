<?php

namespace Tests;

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Désactiver le CSRF pour les tests
        $this->withoutMiddleware([
            ValidateCsrfToken::class,
        ]);

        // Désactiver Vite pendant les tests
        $this->withoutVite();
    }
}
