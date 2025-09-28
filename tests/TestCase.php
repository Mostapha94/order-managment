<?php
namespace Tests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase {
    use RefreshDatabase;
    protected function setUp(): void {
        parent::setUp();
    }
    protected function getPackageProviders($app) { return []; }
    protected function getEnvironmentSetUp($app){}
}
