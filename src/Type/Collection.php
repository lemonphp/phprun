<?php

namespace Lemon\PHPRun\Type;

/**
 * Collection type.
 *
 * An implement of collection interface.
 */
class Collection implements CollectionInterface, \Countable
{
    /**
     * @var array
     */
    private $collection = [];

    /**
     * Key name to retrieve
     *
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        if ($this->has($name)) {
            return $this->collection[$name];
        }

        throw new \RuntimeException();
    }

    /**
     * Assign a value to the specified name
     *
     * @param string $name
     * @param mixed $object
     * @return void
     */
    public function set($name, $object)
    {
        $this->collection[$name] = $object;
    }

    /**
     * Check exist key name
     *
     * @param string $name
     * @return mixed
     */
    public function has($name)
    {
        return isset($this->collection[$name]) || array_key_exists($name, $this->collection);
    }

    /**
     * Remove by key name
     *
     * @param string $name
     */
    public function remove($name)
    {
        unset($this->collection[$name]);
    }

	/**
	 * Offset to retrieve
     *
	 * @param mixed $offset     The offset to retrieve.
	 * @return mixed            Can return all value types.
     * @see get()
	 */
	public function offsetGet ($offset)
    {
        return $this->get($offset);
    }

	/**
	 * Assign a value to the specified offset
     *
	 * @param mixed $offset     The offset to assign the value to.
	 * @param mixed $value      The value to set.
	 * @return void             No value is returned.
     * @see set()
	 */
	public function offsetSet ($offset, $value)
    {
        return $this->set($offset, $value);
    }

    /**
	 * Whether an offset exists
     *
	 * @param mixed $offset     An offset to check for.
	 * @return boolean          TRUE on success or FALSE on failure.
     * @see has()
	 */
	public function offsetExists ($offset)
    {
        return $this->has($offset);
    }

	/**
	 * Unset an offset
     *
	 * @param mixed $offset     The offset to unset.
	 * @return void             No value is returned.
     * @see remove()
	 */
	public function offsetUnset ($offset)
    {
        $this->remove($offset);
    }

    /**
     * Count number of items
     *
     * @return int
     */
    public function count()
    {
        return count($this->collection);
    }

    /**
	 * Retrieve an external iterator
     *
	 * @return Traversable
	 */
    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }
}