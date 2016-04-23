<?php
namespace tests\helpers;

/**
 * Class Factory
 *
 * @package tests\helpers
 */
trait Factory
{
    /**
     * @param       $type
     * @param array $fields
     */
    public function make($type, array $fields = [])
    {
        $stub = $this->getStub();
        if ($stub && is_array($stub)) {
            $fields = array_merge($stub, $fields);
        }

        $type::create($fields);
    }

    /**
     * by default will throw an exception
     */
    protected function getStub()
    {
        throw new \BadMethodCallException('create your own getstub function');
    }
}