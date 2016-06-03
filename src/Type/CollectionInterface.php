<?php

namespace Lemon\PHPRun\Type;

/**
 * Collection interface.
 */
interface CollectionInterface extends \IteratorAggregate, \ArrayAccess
{
    /**
     * Get value by key name
     *
     * @param string $name
     * @return mixed
     */
    public function get($name);

    /**
     * Set value for key name
     *
     * @param string $name
     * @param mixed $object
     */
    public function set($name, $object);

    /**
     * Check exist key name
     *
     * @param string $name
     * @return mixed
     */
    public function has($name);

    /**
     * Remove by key name
     *
     * @param string $name
     */
    public function remove($name);
}