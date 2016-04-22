<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

/**
 * Class ApiTest
 */
class ApiTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * @var \Faker\Factory $fake
     */
    protected $fake;

    /**
     * ApiTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->fake = Faker::create();
    }
}