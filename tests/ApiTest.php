<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

/**
 * Class ApiTest
 */
abstract class ApiTest extends TestCase
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

    /**
     * @param       $type
     * @param array $fields
     */
    protected function make($type, array $fields = [])
    {
        $records = array_merge($this->getStub(), $fields);
        $type::create($records);
    }

    /**
     * by default will throw an exception
     */
    protected function getStub()
    {
        throw new BadMethodCallException('create your own getstub function');
    }

    /**
     * @param $url
     *
     * @return object
     */
    protected function getJson($url)
    {
        return json_decode($this->call('GET', $url)->getContent());
    }

    /**
     * assert helper
     */
    protected function assertObjectHasAttributes()
    {
        $args = func_get_args();
        if (!$args || count($args) < 2) {
            return;
        }

        $object = array_shift($args);
        foreach ($args[0] as $attribute) {
            $this->assertObjecthasAttribute($attribute, $object);
        }
    }
}