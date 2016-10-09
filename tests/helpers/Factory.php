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
     * @param int   $copies
     * @param array $fields
     */
    public function make($type, $copies = 0, array $fields = [])
    {
        $stub = $this->getStub();
        if ($stub && is_array($stub)) {
            $fields = array_merge($stub, $fields);
        }

        do {
            $type::create($fields);
            $copies--;
        } while ($copies > 0);
    }

    /**
     * by default will throw an exception
     */
    protected function getStub()
    {
        throw new \BadMethodCallException('create your own getstub function');
    }
}