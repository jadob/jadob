<?php

namespace Slice\Form\Field;

/**
 * Description of InputCollection
 *
 * @author pizzaminded <miki@appvende.net>
 */
class InputCollection implements /** \ArrayAccess,* */ FormFieldInterface, \Iterator {

    private $container = array();
    protected $name;

    public function __construct() {
        $this->name = uniqid('input-collection');
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function rewind() {
        return reset($this->container);
    }

    public function current() {
        return current($this->container);
    }

    public function key() {
        return key($this->container);
    }

    public function next() {
        return next($this->container);
    }

    public function valid() {
        return key($this->container) !== null;
    }

    public function add($object) {
        $this->container[] = $object;
    }

}
